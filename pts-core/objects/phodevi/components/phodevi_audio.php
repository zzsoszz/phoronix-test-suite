<?php

/*
	Phoronix Test Suite
	URLs: http://www.phoronix.com, http://www.phoronix-test-suite.com/
	Copyright (C) 2010, Phoronix Media
	Copyright (C) 2010, Michael Larabel
	phodevi_audio.php: The PTS Device Interface object for audio / sound cards

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

class phodevi_audio extends phodevi_device_interface
{
	public static function read_property($identifier)
	{
		switch($identifier)
		{
			case "identifier":
				$property = new phodevi_device_property("audio_processor_string", PHODEVI_SMART_CACHE);
				break;
		}

		return $property;
	}
	public static function audio_processor_string()
	{
		$audio = null;

		if(IS_MACOSX)
		{
			// TODO: implement
		}
		else if(IS_BSD)
		{
			// TODO: implement
		}
		else if(IS_WINDOWS)
		{
			// TODO: implement
		}
		else if(IS_LINUX)
		{
			foreach(pts_file_io::glob("/sys/class/sound/card*/hwC0D0/vendor_name") as $vendor_name)
			{
				$card_dir = dirname($vendor_name) . '/';

				if(!is_readable($card_dir . "chip_name"))
				{
					continue;
				}


				$vendor_name = pts_file_get_contents($vendor_name);
				$chip_name = pts_file_get_contents($card_dir . "chip_name");

				$audio = $vendor_name . ' '. $chip_name;
				break;
			}
		}

		return $audio;
	}
}

?>
