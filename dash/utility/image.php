<?php
namespace dash\utility;

/** Images manipulation class **/
class image
{
	/**
	 * True if an image is loaded, false otherwise
	 * @var bool
	 */
	private static $loaded = false;

	/**
	 * Image resource
	 * @var resource
	 */
	private static $img;

	/**
	 * Width of the image
	 * @var int
	 */
	private static $width;

	/**
	 * Height of the image
	 * @var int
	 */
	private static $height;

	/**
	 * Type of the image, relative to IMAGETYPE_* constants
	 * @var int
	 */
	private static $type;

	/**
	 * Quality of the image in percentage (JPEG only)
	 * @var int
	 */
	private static $quality = 90;


	/**
	 * Loads an image file
	 *
	 * @param string $filepath	Path of the image file
	 */
	public static function load($filepath, $_once = false)
	{
		if($_once)
		{
			if(self::$loaded)
			{
				return true;
			}
		}

		self::$loaded = false;

		if(!\dash\file::exists($filepath))
		{
			return false;
		}

		list(self::$width, self::$height, $type) = @getimagesize($filepath);

		self::$img = null;

		if($type == IMAGETYPE_JPEG)
		{
			self::$img = @imagecreatefromjpeg($filepath);
		}
		else if($type == IMAGETYPE_GIF)
		{
			self::$img = @imagecreatefromgif($filepath);
		}
		else if($type == IMAGETYPE_PNG)
		{
			self::$img = @imagecreatefrompng($filepath);
		}
		elseif($type == IMAGETYPE_WBMP)
		{
			self::$img = @imagecreatefromwbmp($filepath);
		}
		elseif($type == IMAGETYPE_WEBP)
		{
			self::$img = @imagecreatefromwebp($filepath);
		}
		else
		{
			return false;
		}

		if(!isset(self::$img))
		{
			return false;
		}

		self::$type = $type;

		// Preservation of the transparence / alpha for PNG and GIF
		if($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG)
		{
			@imagealphablending(self::$img, false);
			@imagesavealpha(self::$img, true);
		}

		self::$loaded = true;
	}


	/**
	 * Writes the image file from the image resource
	 *
	 * @param string $filepath	Path of the image file
	 */
	public static function save($img, $filepath)
	{
		if(!self::$loaded)
		{
			return false;
		}

		if(self::$type == IMAGETYPE_JPEG)
		{
			@imagejpeg($img, $filepath, self::$quality);
		}
		elseif(self::$type == IMAGETYPE_GIF)
		{
			@imagegif($img, $filepath);
		}
		elseif(self::$type == IMAGETYPE_PNG)
		{
			@imagepng($img, $filepath);
		}
		elseif(self::$type == IMAGETYPE_WEBP || self::$type == IMAGETYPE_WBMP)
		{
			@imagewbmp($img, $filepath);
		}
	}


	/**
	 * Set the quality of the image (JPEG only)
	 *
	 * @param int $quality
	 */
	public static function setQuality($quality)
	{
		self::$quality = $quality;
	}


	/**
	 * Creates an new image resource
	 *
	 * @param int $width	Width of the image
	 * @param int $height	Height of the image
	 * @param bool $alpha	Activates alpha channel if true (optionnal)
	 * @return resource	New image resource
	 */
	private static function create($width, $height, $alpha = null)
	{
		if(!isset($alpha))
		{
			$alpha = self::$type == IMAGETYPE_GIF || self::$type == IMAGETYPE_PNG;
		}

		$img = @imagecreatetruecolor($width, $height);

		// Preservation of the transparence / alpha for PNG and GIF
		if($alpha)
		{
			@imagealphablending($img, false);
			@imagesavealpha($img, true);
		}

		return $img;
	}


	/**
	 * Crops the image
	 *
	 * @param int $src_x	X-coordinate of source point
	 * @param int $src_x	Y-coordinate of source point
	 * @param int $src_w	Width of source
	 * @param int $src_h	Height of source
	 * @param int $dst_w	Width of destination
	 * @param int $dst_h	Height of destination
	 */
	public static function crop($src_x, $src_y, $src_w, $src_h, $dst_w, $dst_h)
	{
		if(!self::$loaded)
		{
			return false;
		}

		$new_img = self::create($dst_w, $dst_h);

		@imagecopyresampled($new_img , self::$img, 0, 0, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

		return $new_img;
	}

	/**
	 * Resizes the image
	 *
	 * @param int $width	New width
	 * @param int $height	New height
	 */
	public static function resize($width, $height)
	{
		if(!self::$loaded)
		{
			return false;
		}

		return self::crop(0, 0, self::$width, self::$height, $width, $height);
	}


	/**
	 * Resizes the width the image
	 *
	 * @param int $width	New width
	 * @param bool $prop	Keeps the proportions if true
	 */
	public static function setWidth($width, $prop=true)
	{
		if(!self::$loaded)
		{
			return false;
		}

		if($prop)
		{
			$height = round(self::$height*$width/self::$width);
		}
		else
		{
			$height = self::$height;
		}

		return self::resize($width, $height);
	}


	/**
	 * Resizes the height the image
	 *
	 * @param int $height	New height
	 * @param bool $prop	Keeps the proportions if true
	 */
	public static function setHeight($height, $prop=false)
	{
		if(!self::$loaded)
		{
			return false;
		}

		if($prop)
		{
			$width = round(self::$width*$height/self::$height);
		}
		else
		{
			$width = self::$width;
		}

		return self::resize($width, $height);
	}


	/**
	 * Miniaturizes the image to the wanted size, with cropping
	 *
	 * @param int $width	Width of the thumb
	 * @param int $height	Height of the thumb
	 */
	public static function thumb($width=null, $height=null)
	{
		if(!self::$loaded)
		{
			return false;
		}

		if(!isset($width) && !isset($height))
		{
			return false;
		}

		if(!isset($width))
		{
			$width = round(self::$width*$height/self::$height);
		}

		if(!isset($height))
		{
			$height = round(self::$height*$width/self::$width);
		}

		$ratio_ex = self::$width / self::$height;
		$ratio = $width / $height;

		if($ratio_ex < $ratio)
		{
			$height_ratio = self::$width / $ratio;
			$height_half_diff = round((self::$height - $height_ratio) / 2);
			return self::crop(0, $height_half_diff, self::$width, $height_ratio, $width, $height);
		}
		else
		{
			$width_ratio = self::$height * $ratio;
			$width_half_diff = round((self::$width - $width_ratio) / 2);
			return self::crop($width_half_diff, 0, $width_ratio, self::$height, $width, $height);
		}
	}





	public static function get_ratio($_addr, $_full = false)
	{
		if(!is_file($_addr))
		{
			return null;
		}

		list($width, $height) = @getimagesize($_addr);

		if(!is_numeric($width) || !is_numeric($height))
		{
			return null;
		}

		if($height <= 0)
		{
			$height = 1;
		}

		$ratio = $width / $height;
		$ratio = round($ratio, 5);

		if($_full)
		{
			return
			[
				'width'  => $width,
				'height' => $height,
				'ratio'  => $ratio,
			];
		}
		else
		{
			return $ratio;
		}


	}


	public static function check_square($_file_addr)
	{
		$detail = @getimagesize($_file_addr);

		if(isset($detail[0]) && isset($detail[1]))
		{
			if(intval($detail[0]) === intval($detail[1]))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}

		return null;
	}


	public static function responsive_image_size()
	{
		return
		[
			120,
			220,
			300,
			460,
			780,
			1100,
		];
	}


	public static function make_webp_image($_file_addr, $_new_addr, $_width, $_load_once = false)
	{
		self::load($_file_addr, $_load_once);

		if(!self::$loaded)
		{
			return false;
		}

		if($_width === 120)
		{
			// make thumb
			$new_img = \dash\utility\image::thumb(120, 120);
		}
		else
		{
			if(self::$width < $_width)
			{
				$_width = self::$width;
			}

			$new_img = \dash\utility\image::setWidth($_width);

		}

		@imagewebp($new_img, $_new_addr, 80);
		@imagedestroy($new_img);


		return true;

	}

}
?>