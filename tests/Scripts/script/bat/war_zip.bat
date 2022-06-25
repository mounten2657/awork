@echo off

set zfile=SMP_SoftwareShop
D:
cd D:\code\war\%zfile%
D:\program\zip7\7-Zip\7z a -tzip %zfile%.zip .\*
move /y D:\code\war\%zfile%\%zfile%.zip D:\download\%zfile%.war

::pause

