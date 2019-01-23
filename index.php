<?php

	echo   "<html>
			<head>
				<title>Articles and Events</title>			
				<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css' integrity='sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS' crossorigin='anonymous'>
				<link href='/style.css' rel='stylesheet'>
			</head>
			<body>
				<div class='top-bar'>
					<div class='image-container'>
						<img src='images/image.png' id='logo' alt='logo'>
					</div>
				</div>

				<div id='container'>
					<div class='col-sm-8 float-left articles'>
						<h3 id='title_article'>Articles</h3>
							<div class='col-sm-12'>
								<div class='row'>";

						$file = file_get_contents('data/articles.json');
						$array = json_decode($file, true);

						foreach($array as $array) {
							echo 	"	<div class='col-sm-6 float-left'> 
											<div class='article'>
												<div class='border-custom'>
													<div class='article_title'>".$array['title']."</div>
												</div>
												<img src='".$array['image']."'id = 'articles_image' class='img-fluid' </img>
												<div class='article_content'><p>";
													$content = $array['content'];
													$content = str_replace("<p>", "", $content);
													if (strlen($content) > 90) {
														$content = substr($content, 0, 90).'...'; // Restrict content to 90 characters.
													}
										   echo $content."<a href='".$array['url']."'><br>Read More</a></div>
											</div>
										</div>";
						}



			   			echo"</div>
						</div>
					</div>
					<div class='col-sm-4 float-right'>
						<h3 id='title_events'>Events</h3>";

						$eventsFile = file_get_contents('data/events.json');
						$userFile = file_get_contents('data/user.json');
						$eventsArray = json_decode($eventsFile, true);
						$userArray = json_decode($userFile, true);
						$interests = $userArray['interests'];

						foreach($eventsArray as $eventsArray) {

							$eventTags = $eventsArray['tags'];
							$length = count($interests); // Count number of user interests

							for ($i = 0; $i<$length; $i++) { //Iterate through array to display events that match user interests
								$arraySearch = array_search($interests[$i], $eventTags);

								if(false !== $arraySearch) { // If interest can be found in the event tags, then display event details

								   echo"<div class='event_container'>
											<h6 class='event_title'>".$eventsArray['title']."</h6>
											<div id='event'> <span id='event_detail'>Location: </span>".$eventsArray['location']."</div>
											<div id='event'> <span id='event_detail'>Date: </span>".$eventsArray['date']."</div>
										</div>";
										break;
								}
							}
							
						}
			echo"</div></div>
			</body>
			</html>";
?>