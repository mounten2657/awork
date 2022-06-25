@echo off
@setlocal enableextensions enabledelayedexpansion
echo ----------------------------------------------------------------------------------------
echo %date:~0,10% %time:~0,8%
D: && cd D:\code\html
git checkout develop
git status

echo "---git backup"
git add *
git stash save "%date:~0,10% %time:~0,8% - git stash save"

echo "---start update..."
svn update
echo "---<<<"
:: get svn comment
set comment=
for /f "delims=" %%i in ('svn log -l 1 ^| find /v "---" ^| find /v "r11" ') do (
  	set comment=!comment!%%i
)
set comment=%comment:>=[?]%
set comment=%comment:)=[}]%
echo comment=%comment%
:: get changed file
set files=
for /f "delims=" %%i in ('git status') do (
  	set files=!files!%%i
)
echo files=%files%
echo "--->>>"
:: git commit
echo %files% | findstr "working" | findstr "tree" | findstr "clean" >nul && (
    echo "---noting to commit"
) || (
    echo "---start commit..."
    git add *
    git commit -m "update from svn - %comment%"
    git push
    echo "---end commit."
)

echo "---git reback"
set stash=
for /f "delims=" %%i in ('git stash list') do (
    set stash=!stash!%%%i
)
echo stash=%stash%
echo %stash%  | findstr "git" | findstr "stash" | findstr "save" >nul && (
    echo "---find stash"
    git stash pop >nul
    git add *
) || (
    echo "---no stash"
)

echo "---end update."
::pause