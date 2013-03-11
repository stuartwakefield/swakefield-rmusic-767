@echo off
:: Missing clean in composer project

set modules_dir="node_modules"

if exist %modules_dir% (
	echo Removing installed modules
	call rd /S /Q %modules_dir%
)

if errorlevel==0 (
	echo All clean
) else (
	echo There was an error
)