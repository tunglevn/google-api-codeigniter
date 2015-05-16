# google-api-codeigniter 
This project build on Codeigniter 2.2
Developer: Tung Le Blogger http://tungle.vn


# Library
Use google-api-php-client on  https://github.com/google/google-api-php-client
Library google for Codeigniter: Application/libraries/google_library.php
Use library in controller: $this->load->library('google_library',NULL,'google');

#16 05 2015
Build youtube library: Application/libraries/google/youtube_google.php
User library youtube: $this->google->youtube->search($request); 
View more on Application/controllers/google/youtube.php
Demo Search: http://api.tungle.vn/google/youtube/search?q=5s%20online&limit=20
Demo Video: http://api.tungle.vn/google/youtube/video?id=Ia1CbBKJI94

