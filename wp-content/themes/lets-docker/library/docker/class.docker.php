<?php
/**
 *
 * Docker class aims to manage operations about Docker
 *
 * @package Let's Docker
 * @subpackage Docker
 * @since Let's Docker 1.0
 */

use \Symfony\Component\Yaml\Yaml;

class Docker {

	private $apps = [];

	private $projectName = "";

	private $projectSlug = "";

	/**
	 *
	 * This method aims to set private $apps variable
	 *
	 * @param $apps array
	 */
	public function setApps($apps = [])
	{

		if (empty($apps))
		{
			return false;
		}

		$this->apps = $apps;

	}


	/**
	 *
	 * This method aims to set private $projectName variable
	 *
	 * @param $apps array
	 */
	public function setProjectName($projectName = "")
	{

		if ($projectName == '')
		{
			return false;
		}

		$this->projectName = $projectName;

		$this->projectSlug = $this->slugify($projectName);

	}

	/**
	 *
	 * This method aims to create and download docker files
	 *
	 */
	public function letsDocker()
	{	

		foreach( $this->apps as $app)
		{

			$post = get_post($app);
			$meta = get_post_meta($app);

		}


		$array = array(
		    'version' => '2',
		    'services' => [
		    		$this->projectSlug => "asdsd"],
		);

		$yaml = Yaml::dump($array);

		echo "<pre>";
		print_r($yaml);


	}

	/**
	 *
	 * This method aims to generate slug for composer
	 *
	 */
	public function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
	    return 'n-a';
	  }

	  return $text;
	}


}