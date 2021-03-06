# Archived project

I made this so that I could mess around with fancy/terrible table relationship code so I had something to talk about in a particular interview (got the job by the way). The end result idea was for it to be a booking/management/finance system for dogboarders (people who look after dogs at home for a living). I have no interest in continuing this so it's been archived as a result.

## Build
    cp .env.example .env

configure .env variables, set up your hosts file, configure vhosts etc (below might help)

    <VirtualHost dogbooks.local>
      ServerName dogbooks.local
      ServerAlias dogbooks.local
      DocumentRoot "${INSTALL_DIR}/www/dog-books/public"
      <Directory "${INSTALL_DIR}/www/">
        Options +Indexes +Includes +FollowSymLinks +MultiViews
        AllowOverride All
        Require local
      </Directory>
    </VirtualHost>

If your app key didn't auto generate run `artisan key:generate`

    composer install

    npm install

    npm run dev

If you have any issues with version compatibility I used: `npm version 5.3.0`, `composer version 1.6.3`

Request a DB dump from me or run `php artisan migrate` for a blank DB and configure your .env settings

Test your connection with custom command `php artisan connection:status`


## Future Plans

* Build front end profiles and tools to link to any profile by model name and id
* Add vacination data for dogs
* List of breeds, link up with sizes, *other* size table for unknown breeds, breed -> size -> rates
* Limit on how many dogs you're allowed at one time (8 legally), colour code on a calendar how busy they are using this on front page calendar
* Financial details for fiscal year, further pricing data, fields, manipulation etc needed
* Training, sales, expenditures, booking financials
* Multiple users so this can be effectively hosted and used by many (users and password reset tables currently empty)
* Added details to booking such as discounts (% and fixed), outstanding payments, deposit paid (amount), various rates
* No hardcoding, each user can set their own timescales, rates, dog sizes, charges, dog count limit etc

## Current table relationships

BoardingBooking >- Owner >-< Address
BoardingBooking >- Dog >- Size
Owner >-< Dog
