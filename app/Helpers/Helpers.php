<?php

/**
 * Notification Message Section
 */


/**
 * Provides a message for permission denied for privileged users
 * @param string $privilege	privilege name
 * @return array
 */
function underPrivileged($privilege=null) {
	return [
		'heading' => '403 Permission restricted',
		'content' => ($privilege) ? $privilege."'s" : 'You'.' are\'nt allowed to do that.'
	];
}

/**
 * Admin registered notification
 * @param	object	$user	newly registered user object
 * @return array
 */
function adminRegistered($user) {
	return [
		'heading'	=> 'admin registered',
		'content'	=> "{$user->name}({$user->email}) has been registered as <b>{$user->privilege}</b>"
	];
}


/**
 * Returns plural text (#param2) if #param1 is evaluated as > 1
 *
 * If #param1 is string then string length will be evaluated
 * If #param1 is integer then string it will be compared to 1
 * If #param1 is array then array will be counted
 *
 * @param1 string|int|array	$countable
 * @param2 string			$pluralText
 * @return bool|string
 */
function makePlural($countable, $pluralText=null) {
	
	if (is_string($countable)) {
		
		return (strlen($countable) > 1) ? $pluralText : '';
		
	} elseif (is_int($countable)) {
		
		return ($countable > 1) ? $pluralText : '';
		
	} elseif (is_array($countable)) {
		
		return (count($countable) > 1) ? $pluralText : '';
	}
	
	return false;
}


/**
 * Gets a value from the session if session has that
 *
 * @param string $sessionKey Session key to get value
 * @return bool|mixed		If session has that data then that data or false
 */
function getFromSession($sessionKey) {
	
	if (Session::has($sessionKey)) {
		
		return Session::get($sessionKey);
	}
	
	return false;
}

/**
 * Pull (get then forget) a value from the session if session has that
 *
 * @param string $sessionKey Session key to get value
 * @return bool|mixed		If session has that data then that data or false
 */
function pullFromSession($sessionKey) {
	
	if (Session::has($sessionKey)) {
		
		return Session::pull($sessionKey);
	}
	
	return false;
}

/**
 * Gets error message from a form submission error
 * @param	string	$name	field name under validation
 * @return	string	mixed
 */
function getFormError($errors, $name) {
	
	if ($errors->has($name)) {
	
		return $errors->first($name);
	}
	
	return '';
}

/**
 * Checks if any of the listed errors exists int he errors array
 *
 * @param $errors	$errors
 * @param array 	$errorNames
 * @return bool
 */
function ifErrorsHas($errors, array $errorNames) {
	
	foreach ($errorNames as $name) {
		
		if ($errors->has($name)) {
			
			return 1;
			break;
		}
	}
	
	return 0;
}

/**
 * Returns the $print if (form)errors has $errorName
 * otherwise false
 *
 * @param \Illuminate\Support\Collection	$errors	form errors object
 * @param string	$errorName	form (element) name
 * @param mixed		$print	printable
 * @return mixed
 */
function onError($errors, $errorName, $print) {
	
	return ($errors->has($errorName)) ? $print : false;
}

/**
 * If route(name) matches the given route
 * then returns #param2
 * @param string|array	$routeName	Named route's name or array or route names
 * @param string	$print		string to print
 * @return string
 */
function ifRoute($routeName, $print) {
	
	if (is_array($routeName)) {
		
		foreach ($routeName as $rn) {
			
			if (Route::is($rn)) {
				
				return $print;
			}
		}
	} else {
		
		if (Route::is($routeName)) {
			
			return $print;
		}
	}
}

/**
 * If current page url matches the given url
 * @param string $url  link url
 * @param string $print  print content if url matches (optional)
 * @return mixed
 */
function ifUrl($url, $print=null) {
	
	if (Request::is($url)) {
		
		return (empty($print)) ? true : $print;
	}
	
	return false;
}

/**
 * Prints $print if current route is not the
 * provided (named)route $routeName
 *
 * @param string|array	$routeName
 * @param mixed			$print		Printable
 * @return mixed
 */
function ifRouteIsNot($routeName, $print) {
	
	if (is_array($routeName)) {
		
		foreach ($routeName as $rn) {
			
			if (!Route::is($rn)) {
				
				return $print;
			}
		}
	} else {
		
		if (!Route::is($routeName)) {
			
			return $print;
		}
	}
	
	return false;
}

/**
 * Returns an time and date string representing elapsed time
 *
 * @param string $sqlTimeStamp	the time stamp to parse, like: 2017-10-09 13:22:44
 * @param array $format sample format: '%y Year, %m Months and %d Days %i Minuites %s Seconds Ago'
 * @return string		 sample output: 10 Year, 7 Months and 22 Days 16 Minuites 42 Seconds Ago
 */
function getElapsedTime(string $sqlTimeStamp, array $format=['y', 'm', 'd', 'h', 'i','s'])
{
	$elapsedTime = Carbon\Carbon::parse($sqlTimeStamp);
	
	$Age = '';
	
	
	foreach ($format as $f) {
		
		if (($value = $elapsedTime->diff(Carbon\Carbon::now())->format("%{$f}")) > 0) {
		
			switch ($f) {
				
				case 'y':
					$word = ($value > 1) ? ' Years ' : ' Year ';
					$Age .= $value.$word;
					break;
				
				case 'm':
					$word = ($value > 1) ? ' Months ' : ' Month ';
					$Age .= $value.$word;
					break;
					
				case 'd':
					$word = ($value > 1) ? ' Days ' : ' Day ';
					$Age .= $value.$word;
					break;
					
				case 'h':
					
					$word = ($value > 1) ? ' Hours ' : ' Hour ';
					$Age .= $value.$word;
					break;
					
				case 'i':
					$word = ($value > 1) ? ' Minutes ' : ' Minute ';
					$Age .= $value.$word;
					break;
					
				case 's':
					$word = ($value > 1) ? ' Seconds ' : ' Second ';
					$Age .= $value.$word;
					break;
				
				default:
					
					break;
			}
		}
	}
	
	return $Age;
}

/**
 * Replace white space to dash (-)
 *
 * @param string $string
 * @return string
 */
function spaceToDash($string) {
	
	return str_replace(' ', '-', trim($string));
}

/**
 * Replace dash (-) to white space
 *
 * @param string $string
 * @return string
 */
function dashToSpace($string) {
	
	return str_replace('-', ' ', trim($string));
}

/**
 * Adds suffix to numbers
 * like 1 to 1st
 *
 * @param $number
 * @return string
 */
function addSuffix($number) {
	
	switch ($number) {
		
		case $number == 1:
			return $number.'st';
			break;
		
		case $number == 2:
			return $number.'nd';
			break;
		
		case $number == 3:
			return $number.'rd';
			break;
		
		default:
			return $number.'th';
			break;
	}
}

/**
 * Checks if current user is logged in or not
 *
 * @param null $guard
 * @return bool
 */
function isLoggedIn($guard=null) {
	
	return Auth::guard($guard)->check();
}

/**
 * Gets currently authenticated user
 * Returns false or user if current user is authenticated
 *
 * @return \App\User|bool
 */
function getAuthUser() {
	
	if (isLoggedIn()) {
		
		return Auth::user();
		
	} else {
		
		return false;
	}
	
}

/**
 * Formats given time string or current time
 * if no parameters passed & returns it
 *
 * @param string $timeString
 * @return string
 */
function formatTime($timeString='') {
	
	$format = 'M d, Y @ h:i a';
	
	if (!empty($timeString)) {
		$t = date($format, strtotime($timeString));
	} else {
		$t = date($format);
	}
	
	return $t;
}

/**
 * Secure nl2br
 *
 * Sanitize string & converts new line character to tab
 * Converts html chars & strip all html tags
 *
 * @param string $string
 * @return string
 */
function sNl2br($string) {
	
	// Convert special characters to HTML entities
	$round1 = htmlspecialchars($string, ENT_QUOTES|ENT_HTML5);
	
	// Strip HTML and PHP tags
	$round2 = strip_tags($round1);
	
	return nl2br($round2);
}

/**
 * Generally flash some data to the session
 * if $permanent is true then put to session
 *
 * @param string $name		session key name
 * @param mixed $data		data to put to the session
 * @param bool $permanent	flash or not
 */
function sendNotification($data, $name='notify', $permanent=false) {
	
	if ($permanent) {
		Session::put($name, $data);
	} else {
		Session::flash($name, $data);
	}
}

/**
 * Primary purpose is add 's' / 'es' to the print word
 * but it can be used wisely in other situations too.
 *
 * @param mixed  $int
 * @param string $word
 * @param string $add
 * @return string
 */
function addPlural($int, $word, $add='s') {
	
	if ($int > 1) {
		
		return $word.$add;
	}
	
	return $word;
}

/**
 * Returns SQL formatted current time
 *
 * @return string
 */
function currentSqlFormattedTime() {
	return strftime('%F %T');
}

/**
 * Formats a given time to sql format
 *
 * @param string $timeString
 * @return string
 */
function formatDateTimeSQL($timeString) {
	return strftime('%F %T', strtotime($timeString));
}

/**
 * Formats given time to the specified format
 * (24-07-18 @ 4:32 PM)
 * if dateOnly is true then this will output only date
 *
 * if format is given then formats time according to it
 *
 * @param string $timeString
 * @param bool|string $dateOnly
 * @param bool|string $format
 * @return string
 */
function formatDateTime($timeString, $dateOnly=false, $format=false) {
	
	$format = ($dateOnly) ? '%F' : (($format) ? $format : '%F @ %I:%M %p');
	
	return strftime($format, strtotime($timeString));
	// return date('Y-m-d @ h:i A', strtotime($timeString));
}

function formatMonthDate($timeString, $shortMonth=false, $monthOnly=false) {
	
	$format = ($monthOnly) ? (($shortMonth) ? '%b' : '%B') : ((($shortMonth) ? '%b' : '%B').', %d');
	
	return strftime($format, strtotime($timeString));
}

/**
 * Formats given time to the specified format
 * (4:32 PM)
 *
 *
 * @param string $timeString
 * @return string
 */
function formatTimeOnly($timeString) {
	
	$format = '%I : %M %p';
	
	return strftime($format, strtotime($timeString));
}

/**
 * Processes / converts general YouTube links to embed links
 *
 * Here is a sample of the URLs this regex matches: (there can be more content after the given URL that will be ignored)
 * http://youtu.be/dQw4w9WgXcQ
 * http://www.youtube.com/embed/dQw4w9WgXcQ
 * http://www.youtube.com/watch?v=dQw4w9WgXcQ
 * http://www.youtube.com/?v=dQw4w9WgXcQ
 * http://www.youtube.com/v/dQw4w9WgXcQ
 * http://www.youtube.com/e/dQw4w9WgXcQ
 * http://www.youtube.com/user/username#p/u/11/dQw4w9WgXcQ
 * http://www.youtube.com/sandalsResorts#p/c/54B8C800269D7C1B/0/dQw4w9WgXcQ
 * http://www.youtube.com/watch?feature=player_embedded&v=dQw4w9WgXcQ
 * http://www.youtube.com/?feature=player_embedded&v=dQw4w9WgXcQ
 * It also works on the youtube-nocookie.com URL with the same above options.
 * It will also pull the ID from the URL in an embed code (both iframe and object tags)
 *
 * @param string	$YouTubeUrl		Youtube URI
 * @param string	$UrlParameters	URI parameters lke '?rel=0&amp;showinfo=0' for hiding info & suggested
 *                              	contents after video playback
 * @return string					Processed youtube embed URI
 */
function YTUrl2Embed($YouTubeUrl, $UrlParameters='?rel=0&amp;showinfo=0') {
	
	$regEX = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
	
	preg_match($regEX, $YouTubeUrl, $match);
	
	$videoId = $match[1];
	
	return "http://www.youtube.com/embed/{$videoId}".$UrlParameters;
}

/**
 * Extracts youtube video id from the url
 *
 * @param string $youtebeVideoUrl
 * @return mixed
 */
function YtUrl2VideoId($youtebeVideoUrl) {
	
	$regEX = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
	
	preg_match($regEX, $youtebeVideoUrl, $match);
	
	$videoId = $match[1];
	
	return $videoId;
}

/**
 * Returns past or future date based on supplied parameters
 *
 * If $past is provided & $future is empty
 * then the past date is returned or vice versa
 *
 * ** only pass one param at a time & keep other as false
 *    if both parameters are passed then only past date will be returned
 *    if both parameters are false then current date is returned
 *
 * @param int|bool $pastYears	Number of years to subtract from current year
 * @param int|bool $futureYears	Number of years to add to current year
 * @return string			Year string
 */
function yearPastOrFuture($pastYears, $futureYears=false) {
	
	$currentDate = \Carbon\Carbon::createFromTime();
	
	if ($pastYears) {
		
		$currentDate->subYear($pastYears);
		$yearsDate = $currentDate->toDateString();
	} else {
		
		$currentDate->addYear($futureYears);
		$yearsDate = $currentDate->toDateString();
	}
	
	return $yearsDate;
}

/**
 * Provides user image name or default image based
 * user name
 *
 * @param string|null $imageName
 * @param string $userName
 * @param string $extension
 * @return string
 */
function userImage($imageName, string $userName, string $extension='png') :string {
	
	if (empty($imageName)) {
		
		// getting first character of user name
		$char = strtolower(substr($userName, 0, 1));
		
		$imgName = "{$char}.{$extension}";
		
	} else {
		
		$imgName = $imageName;
	}
	
	$url = config('app.upload_dirs.user') . $imgName;
	
	return asset(str_replace('\\', '/', $url));
}

