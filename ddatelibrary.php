<?php
/*
 * PHP Discordian Date Conversion Library
 * 
 * THis code was ported on the 53th day of Discord in the Year of Our Lady of Discord 3178 by Daniel Kirstenpfad from the C# version
 * which was written on the 27th day of Confusion in the Year of Our Lady of Discord 3175 by Daniel Kirstenpfad, http://www.technology-ninja.com 
 * which was based upon DiscDate.c written on the 65th day of The Aftermath in the Year of Our Lady of Discord 3157 
 *      by Druel the Chaotic aka Jeremy Johnson aka mpython@gnu.ai.mit.edu; Worcester MA 01609
 *      
 * You may use it according to the Creative Commons License: BY-NC. 
 * (see attached licensed.txt for full license text)
 * */

class DiscordianDate
{
    public $season;
    public $day;
    public $yday;
    public $year;
    public $StTibsDay;

	private $Seasons = array('Chaos','Discord','Confusion', 'Bureaucracy', 'The Aftermath');
	private $Holidays = array('Mungday' => 'Chaoflux', 'Mojoday' => 'Discoflux', 'Syaday' => 'Confuflux', 'Zaraday' => 'Bureflux', 'Maladay' => 'Afflux');
    	
    public function __toString()
    {    	
    	$Holiday = "";
   		$ddate = new PHPDiscordianDate();
    	
    	if (($day == 5) || ($day == 50))
    	{
    		if ($day == 5)
    		{
    			$Holiday = " Celebrate "+ $Holidays[$season][0];
    		}
    		else 
    		{
    			$Holiday = " Celebrate "+ $Holidays[$season][1];
    		}
    	}
    	
    	if ($StTibsDay == true)
    		$Holiday = " Celebrate St. Tib's Day";
    	
    	return "Today is ".$ddate->GetDayName($this->yday).", the ".$this->day.$ddate->Ending($this->day)." day of ". $this->Seasons[$this->season]. " in the YOLD ". $this->year . $Holiday."\n";
    }    
}

class PHPDiscordianDate
{	
	private $Days = array('Sweetmorn','Boomtime','Pungenday','Prickle-Prickle','Setting Orange');
	
	public function GetDayName($DayNumber)
    {
    	while ($DayNumber > 5)
    	{
    		$DayNumber-=5;
    	}
    	return $this->Days[$DayNumber-1];
    }
	
	
	public function Ending($Number) 
	{
        $Output = "";
        $temp = $Number%10;
        
        if ($Number > 4)
        	return "th";
        
        switch ($temp)
        {
        	case 1:
        		$Output = "st";
        		break;
        	case 2:
        		$Output = "nd";
        		break;
        	case 3:
        		$Output = "rd";
        		break;
        	default:
        		$Output = "th";
        		break;
        }
        
        return $Output;
    }

    private function Convert($nday, $nyear)
    {
    	$Output = new DiscordianDate();
    	
    	$Output->year = $nyear+3066;
    	$Output->day = $nday;
    	$Output->season = 0;
    	
    	if ($Output->year%4 == 2)
    	{
    		if ($Output->day == 59)
    			$Output->day=-1;
    		else
    			if ($Output->day > 59)
    				$Output->day-=1;
    	}
    	
	    $Output->yday = $Output->day;
	    
	    while($Output->day > 73)
	    {
	    	$Output->season++;
	    	$Output->day-=73;	
	    }
    	return $Output;
    }
    
    public function MakeDay($imonth, $iday, $iyear)
    {
    	$Output = new DiscordianDate();

    	$cal[0] = array(31,28,31,30,31,30,31,31,30,31,30,31);
    	$cal[1] = array(31,29,31,30,31,30,31,31,30,31,30,31);
    	
    	$dayspast = 0;
    	$imonth--;
    	$Output->year = $iyear+1166;
    	
    	if ( ($imonth == 2) && ($iday == 29) )
    	{
    		$Output->StTibsDay = true;
    	}
    	else
    	{
			$Output->StTibsDay = false;    		
    	}
    	
    	while($imonth > 0)
    	{
    		if ($Output->year%4 == 2)
    		{
    			// 1
    			$dayspast += $cal[1][--$imonth];
    		}
    		else
    		{
    			// 0
    			$dayspast += $cal[0][--$imonth];
    		}
    	}
    	
    	$Output->day = $dayspast+$iday;
    	$Output->season = 0;
    	
    	if ($Output->year%4 == 2)
    	{
    		if ($Output->day == 59)
    		{
    			$Output->day=-1;
    		}
    		else
    		{
    			if ($Output->day > 59)
    			{
    				$Output->day-=1;
    			}
    		}
    	}
    	
    	$Output->yday = $Output->day;
    	
    	while($Output->day>73)
    	{
    		$Output->season++;
    		$Output->day-=73;
    	}
    	
    	return $Output;
    }  
}
?>