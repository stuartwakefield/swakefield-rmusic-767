@echo off
:: Missing clean in composer project

set cwd=%~dp0
set vendor_dir="%cwd%vendor"
set composer_lock_file="%cwd%composer.lock"

if exist %vendor_dir% (
	echo Removing installed dependencies
	call rd /S /Q %vendor_dir%
)

if exist %composer_lock_file% (
	echo Removing lock file
	call del %composer_lock_file%
)

if errorlevel==0 (
	echo All clean
) else (
	echo There was an error
)