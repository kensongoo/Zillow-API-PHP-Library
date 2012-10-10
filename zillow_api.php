<?php

	class Zillow_Api {

		private $zws_id;
		private $zpid;

		public function __construct($zws_id = null)
		{
			if ( ! empty($zws_id)) {
				$this->zws_id = $zws_id;
			}
		}

		public function __set($property, $value)
		{
			$this->$property = $value;
		}

		public function __get($property)
		{
			if (isset($this->$property)) {
				return $this->$property;
			}
		}


		/* Home Valuation API
		 --------------------------------------------------------*/

		/**
		 * @param array $params
		 *		- allowed values in $params are address, citysatezip, and rentzestimate
		 * @retun object
		 */
		public function GetSearchResults($params)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;
			$url = 'http://www.zillow.com/webservice/GetSearchResults.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);

			// save this in object so that we could reuse it
			if ( isset($result->response->results->result->zpid) ) {
				$this->zpid = (string)$result->response->results->result->zpid;
			}

			return $result;
		}

		/**
		 * @param array $params
		 *		- allowed values in $params are zpid (optional), and rentzestimate
		 * @retun object
		 */
		public function GetZestimate($params = null)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;

			// if zpid is not set, we use the previous zpid value
			if ( ! isset($params['zpid'])) {
				if ( ! empty($this->zpid)) {
					$params['zpid'] = $this->zpid;
				}
				else {
					throw new Exception('zpid is required.');
				}
			}

			$url = 'http://www.zillow.com/webservice/GetZestimate.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);

			// save this in object so that we could reuse it
			if ( isset($result->response->zpid) ) {
				$this->zpid = (string)$result->response->zpid;
			}

			return $result;
		}

		/**
		 * @param array $params
		 *		- allowed values in $params are zpid (optional), unit-type, width, height, chartDuration
		 * @retun object
		 */
		public function GetChart($params)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;

			// if zpid is not set, we use the previous zpid value
			if ( ! isset($params['zpid'])) {
				if ( ! empty($this->zpid)) {
					$params['zpid'] = $this->zpid;
				}
				else {
					throw new Exception('zpid is required.');
				}
			}

			$url = 'http://www.zillow.com/webservice/GetChart.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);

			return $result;
		}

		/**
		 * @param array $params
		 *		- allowed values in $params are zpid (optional), count, and rentzestimate
		 * @retun object
		 */
		public function GetComps($params)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;

			// if zpid is not set, we use the previous zpid value
			if ( ! isset($params['zpid'])) {
				if ( ! empty($this->zpid)) {
					$params['zpid'] = $this->zpid;
				}
				else {
					throw new Exception('zpid is required.');
				}
			}

			$url = 'http://www.zillow.com/webservice/GetComps.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);

			// save this in object so that we could reuse it
			if ( isset($result->response->properties->principal->zpid) ) {
				$this->zpid = (string)$result->response->properties->principal->zpid;
			}

			return $result;
		}

		/* Neighborhood Data API
		 --------------------------------------------------------*/

		/**
		 * @param array $params
		 *		- allowed values in $params are regionid, state, city, neighborhood, zip
		 * @retun object
		 */
		public function GetDemographics($params = null)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;

			$url = 'http://www.zillow.com/webservice/GetDemographics.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);

			return $result;
		}

		/**
		 * @param array $params
		 *		- allowed values in $params are regionId, state, county, city, childtype
		 * @retun object
		 */
		public function GetRegionChildren($params)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;

			$url = 'http://www.zillow.com/webservice/GetRegionChildren.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);

			return $result;
		}

		/**
		 * @param array $params
		 *		- allowed values in $params are city, state, neighborhood, zip, unit-type (required), width, height, chartDuration
		 * @retun object
		 */
		public function GetRegionChart($params)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;

			$url = 'http://www.zillow.com/webservice/GetRegionChart.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);

			return $result;
		}
		
		/* Mortgage API
		 --------------------------------------------------------*/
		
		/**
		 * @param array $params
		 *		- allowed values in $params are state, output, and callback
		 * @retun object
		 */
		public function GetRateSummary($params = null)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;

			$url = 'http://www.zillow.com/webservice/GetRateSummary.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);

			return $result;
		}

		/**
		 * @param array $params
		 *		- allowed values in $params are price (required), down, dollarsdown, zip, output, and callback
		 * @retun object
		 */
		public function GetMonthlyPayments($params)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;

			$url = 'http://www.zillow.com/webservice/GetMonthlyPayments.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);

			return $result;
		}
		
		/* Property Details API
		 --------------------------------------------------------*/

		/**
		 * @param array $params
		 *		- allowed values in $params are addres (required), citystatezip (required), and rentzestimate
		 * @retun object
		 */
		public function GetDeepSearchResults($params)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;

			$url = 'http://www.zillow.com/webservice/GetDeepSearchResults.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);
			
			// save this in object so that we could reuse it
			if ( isset($result->response->results->result->zpid) ) {
				$this->zpid = (string)$result->response->results->result->zpid;
			}

			return $result;
		}
		
		/**
		 * @param array $params
		 *		- allowed values in $params are zpid (required, could be reuse), count, and rentzestimate
		 * @retun object
		 */
		public function GetDeepComps($params = null)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;
			
			// if zpid is not set, we use the previous zpid value
			if ( ! isset($params['zpid'])) {
				if ( ! empty($this->zpid)) {
					$params['zpid'] = $this->zpid;
				}
				else {
					throw new Exception('zpid is required.');
				}
			}

			$url = 'http://www.zillow.com/webservice/GetDeepComps.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);
			
			// save this in object so that we could reuse it
			if ( isset($result->response->properties->principal->zpid) ) {
				$this->zpid = (string)$result->response->properties->principal->zpid;
			}

			return $result;
		}

		/**
		 * @param array $params
		 *		- allowed values in $params are zpid (required, could be reuse)
		 * @retun object
		 */
		public function GetUpdatedPropertyDetails($params = null)
		{
			if ( empty($this->zws_id)) {
				throw new Exception('ZWS_id is required.');
			}
			$params['zws-id'] = $this->zws_id;
			
			// if zpid is not set, we use the previous zpid value
			if ( ! isset($params['zpid'])) {
				if ( ! empty($this->zpid)) {
					$params['zpid'] = $this->zpid;
				}
				else {
					throw new Exception('zpid is required.');
				}
			}

			$url = 'http://www.zillow.com/webservice/GetUpdatedPropertyDetails.htm?' . http_build_query($params);
			$result = new SimpleXMLElement($url, 0, true);
			
			// save this in object so that we could reuse it
			if ( isset($result->response->properties->principal->zpid) ) {
				$this->zpid = (string)$result->response->properties->principal->zpid;
			}

			return $result;
		}

	}

?>
