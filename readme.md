Nette Framework Sandbox 2.4 with Texyla
=======================

What is [Nette Framework](http://nette.org)?
--------------------------------------------

Nette Framework is a popular tool for PHP web development. It is designed to be
the most usable and friendliest as possible. It focuses on security and
performance and is definitely one of the safest PHP frameworks.

Nette Framework speaks your language and helps you to easily build better websites.


Installing Nette and Texyla
----------

1. Install Composer: (see http://getcomposer.org/download)

2. Install Git

3. Navigate to your preferable directory and run command

   - git clone https://github.com/petak23/Texyla-Nette-2.4.git
   - cd Texyla-Nette-2.4/
   - pre linux: mkdir log temp webtemp && chmod -R a+rw temp log webtemp
   - pre windows: mkdir log temp webtemp
   - composer install
 


Make directories `temp` `log` `webtemp`  writable. 


It is CRITICAL that file `app/config/config.neon` & whole `app`, `log`
and `temp` directory are NOT accessible directly via a web browser! If you
don't protect this directory from direct web access, anybody will be able to see
your sensitive data. See [security warning](http://nette.org/security-warning).
