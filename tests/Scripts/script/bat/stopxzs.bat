@echo off 

rem chcp 65001

rem get admin permission
%1 mshta vbscript:CreateObject("Shell.Application").ShellExecute("cmd.exe","/c %~s0 ::","","runas",1)(window.close)&&exit

for /l %%i in (1,1,3) do (
    taskkill /f /t /im SmpHelp.exe
    rem echo "С������ֹͣ"
)

echo Y| cacls C:\Windows\SysWOW64\SmpAgent\SmpHelp.exe /c /p everyone:n

mshta vbscript:msgbox("С������ֹͣ",64,"%username%")(window.close)

rem pause