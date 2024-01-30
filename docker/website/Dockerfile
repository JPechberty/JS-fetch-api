FROM debian:12

RUN apt update
RUN apt install apache2 apache2-utils -y

#Ouverture des droits de lecture, modification et execution
RUN echo "Ouverture des droits de lecture, modification et execution"
RUN chmod 777 -R /var/www

# Configuration du WORKDIR
RUN echo "Configuration du WORKDIR"
WORKDIR /var/www/

#ENTRYPOINT apachectl -D FOREGROUND
CMD ["apache2ctl", "-D", "FOREGROUND"]