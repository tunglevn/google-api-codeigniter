<?php if ( !defined('BASEPATH')) exit('No direct script access allowed');
class Youtube_Google extends Google_library 
{
	var $youtube;
	
	function __construct()
	{
		parent::__construct();
		$this->youtube = new Google_Service_YouTube($this->client);
	}
	
	public function search($request)
	{
		$result = array();
		
		if(!$request['q'])
		{
			$result = array(
					'status'	=> 'error',
					'message'	=> 'Query not found'
			);
				
		}
		else 
		{
			try {
				if(!$request['maxResults'])
				{
					$request['maxResults'] = 20;
				}
				$searchResponse = $this->youtube->search->listSearch('id,snippet', $request);
					
				$videos = array();
				$channels = array();
				$playlists = array();
					
			
				foreach ($searchResponse['items'] as $searchResult) {
					switch ($searchResult['id']['kind']) {
						case 'youtube#video':
							$videos[] = array(
							'id'	=> $searchResult['id']['videoId'],
							'title'	=> $searchResult['snippet']['title']
							);
			
							break;
						case 'youtube#channel':
							$channels[] = array(
							'id'	=> $searchResult['id']['channelId'],
							'title'	=> $searchResult['snippet']['title']
							);
								
							break;
						case 'youtube#playlist':
							$playlists[] = array(
							'id'	=> $searchResult['id']['playlistId'],
							'title'	=> $searchResult['snippet']['title']
							);
			
							break;
					}
				}
			
				$result['status'] = 'success';
				$result['result'] = array(
						'video'		=> $videos,
						'channel'	=> $channels,
						'playlist'	=> $playlists,
				);
			
			}
			catch (Google_ServiceException $e) {
				$result = array(
						'status'	=> 'error',
						'message'	=> sprintf('A service error occurred: %s', htmlspecialchars($e->getMessage()))
				);
			
			
			}
			catch (Google_Exception $e) {
				$result = array(
						'status'	=> 'error',
						'message'	=> sprintf('<p>An client error occurred: <code>%s</code></p>',htmlspecialchars($e->getMessage()))
				);
			
			}
		}
		
		
		return $result;
	}

	public function video($id)
	{
		$result = array();
		try {
		
			$Response = $this->youtube->videos->listVideos('snippet,contentDetails', array('id' => $id));
			$thumbs = $Response['items'][0]['snippet']['thumbnails'];
			
			$thumb = array();
			foreach (array('default','medium','high','standard','maxres') as $k => $v)
			{
				if($Response['items'][0]['snippet']['thumbnails'][$v])
				{
					$thumb[$v] = $Response['items'][0]['snippet']['thumbnails'][$v]['url'];
				}
			}
				
			
			$result = array(
					'id'			=> $id,
					'title'			=> $Response['items'][0]['snippet']['title'],
					'duration'		=> yttime($Response['items'][0]['contentDetails']['duration']),
					'description'	=> $Response['items'][0]['snippet']['description'],
					'thumb'			=> $thumb
			);
		}
		catch (Google_ServiceException $e) {
			$result = array(
					'status'	=> 'error',
					'message'	=> sprintf('A service error occurred: %s', htmlspecialchars($e->getMessage()))
			);
				
				
		}
		catch (Google_Exception $e) {
			$result = array(
					'status'	=> 'error',
					'message'	=> sprintf('<p>An client error occurred: <code>%s</code></p>',htmlspecialchars($e->getMessage()))
			);
				
		}
		
		return $result;
	}
}