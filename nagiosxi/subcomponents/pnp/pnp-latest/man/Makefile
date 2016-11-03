############################
# Makefile for PNP-manpage
#
# Last Modified: 08-09-2006
############################

prefix=/usr/local/nagios
exec_prefix=@exec_prefix@
LOGDIR=/usr/local/nagios/var
CFGDIR=/usr/local/nagios/etc/pnp
BINDIR=/usr/local/nagios/bin
LIBEXECDIR=/usr/local/nagios/libexec
CGIDIR=/usr/local/nagios/sbin
HTMLDIR=/usr/local/nagios/share/pnp
INSTALL=/bin/install -c
INSTALL_OPTS=-o nagios -g nagios
COMMAND_OPTS=@COMMAND_OPTS@
STRIP=/bin/strip
MANDIR=@mandir@
DATAROOTDIR=/usr/local/nagios/share/pnp


CP=/bin/cp

none:
	echo "Choose one of these options:"
	echo "install"
	echo "clean distclean"

clean:
	-rm -f *~ *.*~

distclean: clean
	-rm -f Makefile

devclean: distclean

install:
	$(MAKE) install-basic

install-basic:
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(MANDIR)/man1/

	for file in man1/*.1; \
	do $(INSTALL) -m 644 $(INSTALL_OPTS) $$file $(DESTDIR)$(MANDIR)/man1/; done


