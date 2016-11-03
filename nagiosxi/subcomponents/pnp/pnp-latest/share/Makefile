prefix=/usr/local/nagios
LOGDIR=/usr/local/nagios/var
CFGDIR=/usr/local/nagios/etc/pnp
BINDIR=/usr/local/nagios/bin
CGIDIR=/usr/local/nagios/sbin
INSTALL=/bin/install -c
INSTALL_OPTS=-o nagios -g nagios
DATAROOTDIR=/usr/local/nagios/share/pnp

CP=/bin/cp

all html:

clean:

distclean: clean
	-rm pnp/ajax.php
	-rm pnp/zoom.php
	-rm pnp/index.php
	-rm Makefile

devclean: distclean

install:
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(DATAROOTDIR)
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(DATAROOTDIR)/images
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(DATAROOTDIR)/include
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(DATAROOTDIR)/include/font
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(DATAROOTDIR)/include/font/makefont
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(DATAROOTDIR)/include/js
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(DATAROOTDIR)/lang/
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(DATAROOTDIR)/templates/
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(DATAROOTDIR)/templates.dist/
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(DATAROOTDIR)/templates.special/

	for file in pnp/*.php; \
	do $(INSTALL) -m 644 $(INSTALL_OPTS) $$file $(DESTDIR)$(DATAROOTDIR); done

	for file in pnp/templates.dist/*.php; \
	do $(INSTALL) -m 644 $(INSTALL_OPTS) $$file $(DESTDIR)$(DATAROOTDIR)/templates.dist; done

	for file in pnp/templates.special/*.php; \
	do $(INSTALL) -m 644 $(INSTALL_OPTS) $$file $(DESTDIR)$(DATAROOTDIR)/templates.special; done

	for file in pnp/lang/*.php; \
	do $(INSTALL) -m 644 $(INSTALL_OPTS) $$file $(DESTDIR)$(DATAROOTDIR)/lang; done
	
	for file in pnp/images/*; \
	do $(INSTALL) -m 644 $(INSTALL_OPTS) $$file $(DESTDIR)$(DATAROOTDIR)/images; done

	for file in pnp/include/*.*; \
	do $(INSTALL) -m 644 $(INSTALL_OPTS) $$file $(DESTDIR)$(DATAROOTDIR)/include; done

	for file in pnp/include/js/*; \
	do $(INSTALL) -m 644 $(INSTALL_OPTS) $$file $(DESTDIR)$(DATAROOTDIR)/include/js; done

	for file in pnp/include/font/*.php; \
	do $(INSTALL) -m 644 $(INSTALL_OPTS) $$file $(DESTDIR)$(DATAROOTDIR)/include/font; done

	for file in pnp/include/font/makefont/*; \
	do $(INSTALL) -m 644 $(INSTALL_OPTS) $$file $(DESTDIR)$(DATAROOTDIR)/include/font/makefont; done

	
