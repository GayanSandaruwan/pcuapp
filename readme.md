## About Project 

This project is focused on to develop a sytem for hospitals to record and monitor the assesment reports about the patients. Main users of the system are ,
- Nurses.
- Doctors.
- Administrators.

Nurses will use the system to add the details of the new patients and continously monitor and record their health conditions. Depending on the scores calculated considering various parameters including age nurses will be prompted with the correct action to be taken in the situation. Also, for the ease of use of the nurses, they can print the the assessment reports. More over weekly/daily reports on the patient conditions, automatically prompting the critcal patient list in dashboard will add more value to the system.
System is to be testes for the usability and acceptability at Lady ridgway hospital.
## Setting up the project
Recommend to use a linux environment.
Install composer. Then install laravel 5.5 through composer. Install all the dependencies using ``composer install``.
Run ``php artisan migrate:install`` to create the migration table, then, to run the migrations run ``php artisan migrate``. To create the default admin and nurse to start the system, run ``php artisan db:seed``. Run the system on apache or on built in server using ``php artisan serve``.
Not having a internet connection will make the UI's buggy since some stylesheets are loaded through CDN's.



## Contributing

Thank you for considering contributing to the PCU APP project. Add a issue and send the pull requests through git.
## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The PCU APP is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Author
Gayan Sandaruwan De Silva , an undergraduate of University of Moratuwa
