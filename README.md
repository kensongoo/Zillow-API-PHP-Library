#Zillow API PHP Library


This PHP library is to ease the use of Zillow API. As of today (October 10, 2012), this API supports all API functions of Zillow including
* GetSearchResults
* GetZestimate
* GetChart
* GetComps
* GetDemographics
* GetRegionChildren
* GetRegionChart
* GetRateSummary
* GetMonthlyPayments
* GetDeepSearchResults
* GetDeepComps
* GetUpdatedPropertyDetails

## How to use

Your must have your Zillow API key before you could use this library.

$zillow_api = new Zillow_Api($zws_id); // $zws_id is your Zillow API Key  
$search_result = $zillow_api->GetSearchResults(array('address' => '7356 CARTER AVE', 'citystatezip' => 
'NEWARK'));  


Because the library autosave the "zpid" in the object if the function returns one. You could do something like this.

$property = $zillow_api->GetSearchResults(array('address' => '7356 CARTER AVE', 'citystatezip' => 'NEWARK'));  
$estimate = $zillow_api->GetZestimate();  
$chart = $zillow_api->GetChart(array('unit-type' => 'dollar'));  
$comps = $zillow_api->GetComps(array('count' => '10', 'rentzestimate' => true));  

Because the "zpid" is autosaved after the GetSearchResults function was called, you don't have to pass the "zpid" in the subsequent functions calling.



That's all. Happy Hacking!



Created by Kenson Goo, the founder of http://www.sidepon.com.
