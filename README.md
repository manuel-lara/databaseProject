# databaseProject
database project

Description –
This application is for users to report stolen bikes and found
bikes. Users will create an entry for either their stolen bikes or
found bikes that they are trying to return to their owner. Users
will create an account and log in to either view reported bikes or
report a bike. When searching reported bikes, a user can view all
bikes by sorting(location, date, type of bike) or entering
keywords like Serial Number or description. When reporting a
stolen bike a user can enter information of the bike: location,
time and date, physical description, serial number.

Potential Tables -
Users, Bikes, Stolen Bikes, Found bikes, comments/images

Requirements -
• Users can create accounts with username and password
• Users can log in and out
• Users can search and view reported bikes
• Reported Bikes can be sorted by location, date, type of bike, stolen or found
• Users can report bikes in different locations
• All users can post comments on other reports

Business Rules –
• Users must create account to report a found or stolen bike
• Users must sign in to view reported bikes
• A bike serial number can only be reported once on both ‘stolen bikes’ and ‘found bikes’ pages
• Users can report multiple bikes as either stolen or found
• Each ‘stolen bike’ and ‘found bike’ must have exactly one ‘user’
• Users A can see user B’s contact info only if user B has reported a bike
• Users must provide information to create account: full name, phone number, valid email, profile picture
