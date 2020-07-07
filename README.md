# ILL-Form
This is a form takes parameters passed in the URL and fills in fields on the form that is email to a specified email address
The parameters in this case are from Primo VE

Need institutional SMTP server

Minor update needed:

  index.php look for example.com or example and update to fit your needs

  ill-request-do.php file (who email to and smtp server) look for example.com and update

  sendmail.php file in the class folder for smtp again look for example.com and update

Example of the URL with passing parameters (need to change domain name):

https://library.example.com/index.php?title=Testing.&atitle=&aulast=&aufirst=&rft.auinitm=&pub=Pullman&pb=Pullman&place=New+York%2C&issn=00966274/&volume=&issue=&ftpy=/&spage=&epage=&genre=journal&doi=&dat=01353986&eissn=
