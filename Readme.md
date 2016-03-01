# PubSub pattern implementation

##SQL files
query.sql is the mysql file to make the database and table required. There are 4 tables:  
	publisher: stores the name of the publisher
	topic: stores the name and the topic created by the publisher
	subs: stores the topic and the users which have subscribed to the corresponding topic
	message: stores the topic, email, message for the user

##PHP files
index.php
	(Publisher)publisher.php
		publisher2.php
			(send new message)pub.php
			(create new topic)create.php

	(Subscriber)subscriber.php
		(subscribe to new topic)sub.php
			subs.php
		(unsubscribe to topic)unsub.php
		(view messages)view.php
			viewup.php

##Note
Please see that we are mailing messages to subscribers using the php mail as well as we are storing them in database so that user can view them by following the path above.
The old message are displayed normal where as new messages which have been sent after user's last login are displayed in bold.