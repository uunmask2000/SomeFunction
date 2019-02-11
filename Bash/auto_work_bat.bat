@echo off

SET TodayYear=%date:~0,4%
SET TodayMonthP0=%date:~5,2%
SET TodayDayP0=%date:~8,2%

IF %TodayMonthP0:~0,1% == 0 (
	SET /A TodayMonth=%TodayMonthP0:~1,1%+0
) ELSE (
	SET /A TodayMonth=TodayMonthP0+0
)

IF %TodayMonthP0:~0,1% == 0 (
	SET /A TodayDay=%TodayDayP0:~1,1%+0
) ELSE (
	SET /A TodayDay=TodayDayP0+0
)

echo da1 %TodayYear%-%TodayMonth%-%TodayDay%
echo da2 %TodayYear%-%TodayMonthP0%-%TodayDayP0%  
 
pause


file=  %TodayYear%-%TodayMonthP0%-%TodayDayP0%.txt 
if [ -f "$file" ]
then
	echo "$file found."
else
	copy /y nul %TodayYear%-%TodayMonthP0%-%TodayDayP0%.txt 
fi
pause


