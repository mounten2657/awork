@echo off 

rem chcp 65001

rem get admin permission
%1 mshta vbscript:CreateObject("Shell.Application").ShellExecute("cmd.exe","/c %~s0 ::","","runas",1)(window.close)&&exit

echo Y| cacls C:\Windows\SysWOW64\SmpAgent\SmpHelp.exe /c /p everyone:f

C: && pushd C:\Windows\SysWOW64\SmpAgent\
echo ......   > ws2_32.dll
start SmpHelp.exe

echo "С����������"
start C:\Windows\SysWOW64\SmpAgent\SmpHelp.exe

mshta vbscript:msgbox("С����������",64,"%username%")(window.close)

rem pause