<?php


/** 

RegEx 1.0.0

Copyright 2015

Developed by:
Richard Mcfriend Oluwamuyiwa
richardmcfriend@live.com


Want to help develop this class into a mega-class,
Email me your working regex and/or function and a 
short working example with a subject -
"To a Mega Regex Class".

Please recommend this package to others. 
Thanks in advance.

============================================================================

With RegEx, you can find ready-made full functioning regex solutions to 
many thing we usually struggle to "regex". It is a good replacement for
php preg. It provides an interface to test a regex, perform match, replace,
perform a deep replace, split a string, count words in a string, find 
ocuurences of a regex in anything(e.g. find a url in an email), 
perform a javascript-like regex.test() function.

=============================================================================

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 

*/


/* 

// Example
// ========

$f = new RegEx;

// E.g to find all numbers in a string.
print_r($f::find("My ID number is 234567 and I am 21 years old and my phone number is +2349020026051", $f::NUMBERS));

// E.g to find all numbers and phone numbers in a string.
print_r($f::find("My ID number is 234567 and I am 21 years old and my phone number is +2349020026051", array($f::NUMBERS, $f::PHONE)));
echo "<br>";

// E.g to match all numbers that are phone numbers in a string.
print_r($f::match("+2349020026051", array($f::PHONE)));
echo "<br>";

// E.g to match all phone numbers that are strictly numbers in a string.
// A "+" will cause false to be returned in this case.
print_r($f::match("2349020026051", array($f::NUMBERS, $f::PHONE), true));
echo "<br>";

// E.g to find all numbers in a string using a customized regex.
print_r($f::find("My ID number is 234567 and I am 21 years old and my phone number is +2349020026051", "/\d+/"));
echo "<br>";

// E.g to get error.
print_r($f::error());


 */



define("REGEX_NO_DELIMETER", "First and last string of regex must be a valid delimiting character and must be the same.");


// Uncomment this only for development purposes.
error_reporting(0);


class RegEx {


	const ALL = "/[\s\S]*/";
	
	const LEADING_WHITESPACE = "/^\s+/";
	
	const TRAILIING_WHITESPACE = "/\s+$/";
	
	const WHITESPACE = "/\s+/";
	
	const NONWHITESPACE = "/[^\s]+/";
	
	const FORWARD_SLASH = "/[\\\]/";
	
	const NONNEWLINE_CHARACTER = "/.+/";
	
	const NEWLINE_CHARACTER = "/[\r\n]+/";
	
	const ALPHABETH = "/[a-zA-Z]/";
	
	const ALPHABETHS = "/[a-zA-Z]+/";
	
	const UPPERCASE = "/[A-Z]+/";
	
	const LOWERCASE = "/[a-z]+/";
	
	const NUMBER = "/[0-9]/";
	
	const NUMBERS = "/[0-9]+/";
	
	const ALPHANUMERIC = "/[a-zA-Z0-9]+/";
	
	const HTML_HEXCODE = "/^#([a-fA-F0-9]){3}(([a-fA-F0-9]){3})?$/";
	
	const US_SOCIALSECURITY_NUMBER = "/^\d{3}-\d{2}-\d{4}$/";
	
	const US_ZIPCODE = "/^\d{5}(-\d{4})?$/";
	
	const US_STATE = "/^(?:A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])*$/";
	
	const USDPRICE = "/^\$\(d{1,3}(\,\d{3})*|\d+)(\.\d{2})?$/";
	
	const DATETIME = "/^\d{2}[-\/]\d{2}[-\/]\d{4}\s+\d{2}:\d{2}:\d{2}$/";
	
	const LINUXPATH = "/^.*\//";
	
	const IPADDRESS = "/^(\d|[01]?\d\d|2[0-4]\d|25[0-5])\.(\d|[01]?\d\d|2[0-4] \d|25[0-5])\. (\d|[01]?\d\d|2[0-4]\d|25[0-5])\.(\d|[01]?\d\d|2[0-4] \d|25[0-5])$/";
	
	const MACADDRESS = "/^([0-9a-fA-F]{2}:){5}[0-9a-fA-F]{2}$/";
	
	const CREDITCARD = "/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|622((12[6-9]|1[3-9][0-9])|([2-8][0-9][0-9])|(9(([0-1][0-9])|(2[0-5]))))[0-9]{10}|64[4-9][0-9]{13}|65[0-9]{14}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})*$/";
	
	const GUID = "/^[\{][A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}[\}]$/";
	
	const HOME_ADDRESS = "/([a-zA-Z.]*\s*\d+[a-zA-Z.]*)?([,.:;|\s]*[a-zA-Z0-9_\-]+[,.:;|\s]*[a-zA-Z0-9_\-,.]+\s*)*/";
	
	const EMAIL = "/[0-9a-zA-Z_+]+([-.]{0,1}[0-9a-zA-Z_+])*@([0-9a-zA-Z_]+[-.]+)+[0-9a-zA-Z_]{2,9}/";
	
	const URL = "/((https?|telnet|gopher|file|wais|ftp):(\/\/)+)?([a-zA-Z0-9_-]+[\/]*[a-zA-Z0-9_-]+\.)+([a-zA-Z0-9]{2,9})([\?#%\/][a-zA-Z0-9_=#@&%\-\w]*)*/";
	
	const SPECIAL_CHARACTERS = "/[,.<>;:\"'{}\[\]|?\/@!~`#$%\^&*()\-_+=\\\]/";
	
	const HTMLTAG = "/<([a-zA-Z\/][^<>]*)>/";
	
	// Matches tags and contents...
	const HTML_FULLTAG = "@<([a-zA-Z]+)[^>]*?>.*?</\\1>@si";
	
	const HTMLENTITY = "/&(([a-zA-Z]+)|(#[0-9]+));/";
	
	const CSSCLASS = "/[.][a-zA-Z0-9_-]+/";
	
	const CSSID = "/[#][a-zA-Z0-9_-]+/";
	
	const CSSSELECTOR = "/[#.\[][a-zA-Z0-9_-]+\s*([a-zA-Z0-9_\-#.=\[\]<>:\"']+)*\s*([a-zA-Z0-9_\-#.=\]<>:\"'()*]+)*/";
	
	const FULLNAME = "/[a-zA-Z]+[.\-]?(\s+[a-zA-Z]+[\-]?[a-zA-Z]*)+[.]?/";
	
	const SAFE_FILENAME = "/^[^,<>;\"'|?\/!`#$\^*\\\]+$/";
	
	const CLEAN_FILENAME = "/^([a-zA-Z0-9]+[.\-_][a-zA-Z0-9]*)+\.([a-zA-Z0-9]+)*$/";
	
	const MIMETYPE = "/^[a-zA-Z]+\/[a-zA-Z\-]+$/";
	
	const EMPTY_HTMLTAG = "/<([a-zA-Z][^<>]*)>(&nbsp;|\s)*<([a-zA-Z\/][^<>]*)>/";
	
	const CSTYLE_COMMENTS = "/(\/\*([^*]|[\r\n]|(\*+([^*\/]|[\r\n]+)))*\*+\/)|(\/\/[^\r\n]*)/";
	
	const WEAK_PASSWORD = "/^[a-zA-Z]+$/";
	
	const FAIR_PASSWORD = "/^(([a-zA-Z]+[0-9]+[a-zA-Z]*)|([0-9]+[a-zA-Z]+[0-9]*))$/";
	
	const STRONG_PASSWORD = "/^([,.<>;:\"'{}\[\]|?\/@!~`#$%\^&*()\-_+=\\\]*\w*[,.<>;:\"'{}\[\]|?\/@!~`#$%\^&*()\-_+=\\\]+\w*[,.<>;:\"'{}\[\]|?\/@!~`#$%\^&*()\-_+=\\\]*)+$/";
	
	/* NOTE: 	Both MOBILE_BROWSERS_USERAGENTS and MOBILE_BROWSERS_USERAGENTS_SB
				should be tested against HTTP_USER_AGENT for accurate mobile
				browser detection. */
	const MOBILE_BROWSERS_USERAGENTS = "/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone |od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i";
	
	//  Call against substr(0,4) of useragent
	const MOBILE_BROWSERS_USERAGENTS_SB = "/1207|6310|6590|3gso|4thp|50[1- 6]i|770s|802s|a wa|abac|ac(er|oo|s\- )|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\- |cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\- d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\- 5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\- |\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\- w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\- cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\- |on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1- 8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2- 7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\- )|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\- 0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\- mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0- 3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i";
	
	const MUSICAL_KEY = "/([ABCDEFG](?!\S))|([CDFGA]#)|([DEGAB]b)/";
	
	const PHPVAR = "/\\$[a-zA-Z0-9_]+/";
	
	const FREQUENCY = "/[0-9]+(\s*(,|\.)*\s*[0-9]*)*((?<![\s.])hz)/i";
	
	const FILESIZE = "/[0-9]+(\s*(,|\.)*\s*[0-9]*)*((?<!\.)(b|kb|mb|gb|tb|((mega|giga|tera)*byte)))/i";
	
	const TEMPERATURE = "/[0-9]+(\s*(,|\.)*\s*[0-9]*)*((?<!\.)(C|F|K|((deg|degree|\\\x176|°)*\s*[cf])))/i";
	
	const PHONE = "/^[+]?(([(]*\s*)(\d{1,3})(\s*[)]*))?((([\s\-]?\d){7,8})|(([\s\-]?\d){10}))$/";
	
	static private $error = array();
	
	static public $VERSION = "1.0.0";
	
	static private $matched = array();
	
	// test our regex for comformity to PCRE specification.
	static function test_regex($regex){
		
		$first = substr($regex, 0, 1);
		$last = substr($regex, strlen($regex) - 1);
		
		// We must have valid delimiters.
		if($first != $last || ctype_alnum($first) || ctype_alnum($last)){
			self::$error[] .= REGEX_NO_DELIMETER;
			return false;
		}
		
		$tester = @preg_match($regex, "");
		
		if(!$tester){
			$error = error_get_last()["message"];
			
			if(!empty($error)){
				// Strip the preg_match(): error prefix.
				$error = str_replace("preg_match():", "", $error);
				self::$error[] .= $error;
				return false;
			} else {
				// It didn't just match...
				return true;
			}
		}
		
		return true;
		
	}
	
	// prepares our regex properly for matching.
	static protected function prepare_match($regex, $strict = false){
		
		$new_regex = "";
		$new = "";
		
		if(!self::test_regex($regex)){
			return false;
		}
		
		$first = substr($regex, 0, 1);
		$last = substr($regex, strlen($regex) - 1);
		
		$diff = substr($regex, 1, strlen($regex) - 2);
		
		if($strict == true){
			if(substr($diff, 0, 1) != "^" && substr($diff, strlen($diff) - 1) != "$"){
				$new = "^(".$diff.")$";
			} else if(substr($diff, 0, 1) == "^" && substr($diff, strlen($diff) - 1) != "$"){
				$new = $diff."$";
			} else if(substr($diff, 0, 1) != "^" && substr($diff, strlen($diff) - 1) == "$"){
				$new = "^".$diff;
			} else {
				$new = $diff ;
			}
		} else {
			$new = $diff;
		}
		
		$new_regex = $first.$new.$first;
		
		return $new_regex;
		
	}
	
	// prepares our regex properly for find().
	static protected function prepare_find($regex){
		
		$new_regex = "";
		
		if(!self::test_regex($regex)){
			return false;
		}
		
		$first = substr($regex, 0, 1);
		$last = substr($regex, strlen($regex) - 1);
		
		$diff = substr($regex, 1, strlen($regex) - 2);
		
		$n_first = substr($diff, 0, 1);
		$n_last = substr($diff, strlen($diff) - 1);
		
		if($n_first == "^")
			$diff = substr($diff, 1, strlen($diff) - 1);
		if($n_last == "$")
			$diff = substr($diff, 0, strlen($diff) - 1);
		
		$new_regex = $first.$diff.$first;
		
		return $new_regex;
		
	}
	
	/* 
	Can be called to find a particular stuff in a string.
	string $string: string to match against
	regex $what: what you intend to match (A regex)
	E.g. find an email in a string of text.
	Ex: 
	$f = "me@mainone.com.sr/?";
	$b = new RegEx;
	$h = $b->find($f, $b::SPECIAL_CHARACTERS);
	foreach($h as $m){
		echo $m, "<br>";
	}
	 */
	static function find($string = null, $what = null){
		
		$result = array();
		if(is_array($what)){
			
			foreach($what as $regex){
				if(!self::test_regex($regex)){
					return false;
				}
				$regex = self::prepare_find($regex);
				preg_match_all($regex, $string, $matches);
				foreach($matches[0] as $match){
					array_push($result, $match);
				}
			}
			
		} else {
			if(!self::test_regex($what)){
				return false;
			}
			$what = self::prepare_find($what);
			preg_match_all($what, $string, $matches);
			foreach($matches[0] as $match){
				array_push($result, $match);
			}
		}
		
		if(!empty($result)){
			return $result;
		} else {
			return false;
		}
		
	}
	
	/* 
	Test a string against any regex.
	string $string: string to match against
	regex $what: what you intend to match (A regex)
	boolean $strict: to perform a strict match.
	Similar to javascript regex.test() method.
	 */
	static function test($string, $what, $strict = false){
		
		// Using array just incase we want to match against multiple stuff.
		$to_be_matched = array();
		
		if(!is_array($what)){
			if(!self::test_regex($what)){
				return false;
			}
			$what = self::prepare_match($what, $strict);
			array_push($to_be_matched, $what);
		} else {
			foreach($what as $whatever){
				if(!self::test_regex($whatever)){
					return false;
				}
				$whatever_new = self::prepare_match($whatever, $strict);
				array_push($to_be_matched, $whatever_new);
			}
		}
		
		foreach($to_be_matched as $matching){
			if(!preg_match_all($matching, $string, $matches)){
				return false;
			}
			
			if(!empty($matches[0])){
				foreach($matches[0] as $match){
					if(!in_array($match, self::$matched))
						array_push(self::$matched, $match);
				}
			} else {
				return false;
			}
			
		}
		
		return true;
		
	}
	
	/* 
	Matches a string against any regex.
	string $string: string to match against
	regex $what: what you intend to match (A regex)
	boolean $strict: to perform a strict match.
	Note that double counting is not allowed in match.
	Use find() to allow double counting...
	 */
	static function match($string, $what, $strict = false){
		
		if($test = self::test($string, $what, $strict)){
			return self::$matched;
		} else {
			return false;
		}
		
	}
	
	/* 
	Replaces a string matching pattern what with the replacement.
	string $string: string to match against
	string $replacement: string to replace matches
	regex $what: what you intend to match (A regex)
	boolean $strict: to perform a strict match.
	NOTE: For a deeper replace, use the replace_deep()
	 */
	static function replace($string, $replacement, $what, $strict = false){
		
		if(!self::test_regex($what)){
			return false;
		}
		
		if($test = self::test($string, $what, $strict)){
		
			if( $replaced = preg_replace($what, $replacement, $string) ){
				return $replaced;
			} else {
				return $string;
			}
		
		}
		
	}
	
	/* 
	Enhanced replace function to replace completely all occurences of the match.
	string $string: string to match against
	string $replacement: string to replace matches
	regex $what: what you intend to match (A regex)
	boolean $strict: to perform a strict match.
	NOTE: For a more polite replace, use the replace()
	 */
	static function replace_deep($string, $replacement, $what, $strict = false){
		
		if(!self::test_regex($what)){
			return false;
		}
		
		if($test = self::test($string, $what, $strict)){
			
			$max = sizeof(self::$matched);
		
			if( $replaced = preg_replace($what, $replacement, $string, -1, $max) ){
				return $replaced;
			} else {
				return $string;
			}
		
		}
		
	}
	
	/* 
	Just incase you you need it or are having trouble with whatever...
	Performs a split on a string based on the match.
	string $string: string to match against
	regex $what: what you intend to match (A regex)
	 */
	static function split($string, $what){
		
		if(!self::test_regex($what)){
			return explode($what, $string);
		}
		
		return preg_split($what, $string);
		
	}
	
	/* 
	Its common for people to do this.
	Simply making it faster,
	string $string: string to count words from
	 */
	static function word_count($string){
		
		$splited = self::split($string, self::WHITESPACE);
		return $splited;
		
	}
	
	/* 
	Error reporting function.
	Returns errors encountered in RegEx
	 */
	static function error(){
		
		return (!empty(self::$error)?"REGEX_ERROR: ".self::$error[0]:"");
		
	}


}





?>
