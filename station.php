<?php
/*
 * Playlist generator
 *
 * @version 2015-08-30
 * @author François LASSERRE <choiz@me.com>
 * @license GNU GPL {@link http://www.gnu.org/licenses/gpl.html}
 */

class Station
{
    private $name = '';
    private $description = '';
    private $url = '';
    private $servers = [];

    public function __construct($url, $name = "", $description = "")
    {
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
    }

    public function addServer($server)
    {
        if (is_string($server)) {
            $this->servers[] = $server;
        }

        if (is_array($server)) {
            $this->servers = array_merge($this->servers, $server);
        }
    }

    /**
    * Retrieve metadata for Icecast stream
    *
    * @return bool if successful or not with retrieving data
    * @access public
    * @author mribbins
    */
    public function retrieveMetaData()
    {
      $ice_url = $this->servers[0];
      $ice_url .= "/";
      $ice_url .= $this->url;

      $headers = get_headers($ice_url, 1);

      if(array_key_exists('icy-name', $headers)) {
        $this->name = $headers['icy-name'];
      } else {
        return false;
      }
      if(array_key_exists('icy-description', $headers)) {
        $this->description = $headers['icy-description'];
      }
      
      return true;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getServers()
    {
        return $this->servers;
    }
}
