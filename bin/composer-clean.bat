@echo off
:: Missing clean in composer project

set vendor_dir="vendor"
set composer_lock_file="composer.lock"

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