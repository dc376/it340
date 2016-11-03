prefix=/usr/local/nagios
SYSCONFDIR=/usr/local/nagios/etc/pnp
BINDIR=/usr/local/nagios/bin
LIBEXECDIR=/usr/local/nagios/libexec
CGIDIR=/usr/local/nagios/sbin
HTMLDIR=/usr/local/nagios/share/pnp
INSTALL=/bin/install -c
INSTALL_OPTS=-o nagios -g nagios
PERFDATADIR=/usr/local/nagios/share/perfdata
DATAROOTDIR=/usr/local/nagios/share/pnp

CP=/bin/cp

all html:

clean:
	-rm -f pnp/config.php
	-rm -f pnp/process_perfdata.cfg-sample
	-rm -f pnp/npcd.cfg-sample
	-rm -f misccommands.sample 
	-rm -f xinetd.pnp.sample
	-rm -f pnp/pnp4nagios_release

distclean: clean
	-rm Makefile

devclean: distclean

install:
	-rm -f $(DESTDIR)$(HTMLDIR)/conf/config.php

	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(SYSCONFDIR)
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(SYSCONFDIR)/check_commands
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(SYSCONFDIR)/pages
	$(INSTALL) -m 644 $(INSTALL_OPTS)  pnp/pnp4nagios_release $(DESTDIR)$(SYSCONFDIR)
	$(INSTALL) -m 644 $(INSTALL_OPTS)  pnp/config.php $(DESTDIR)$(SYSCONFDIR)
	$(INSTALL) -m 644 $(INSTALL_OPTS)  pnp/background.pdf $(DESTDIR)$(SYSCONFDIR)

install-config: 
	-rm -f $(DESTDIR)$(HTMLDIR)/conf/config.php

	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(SYSCONFDIR)
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(SYSCONFDIR)/check_commands
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(SYSCONFDIR)/pages
	
	$(INSTALL) -m 644 $(INSTALL_OPTS)  pnp/config.php $(DESTDIR)$(SYSCONFDIR)
	$(INSTALL) -m 644 $(INSTALL_OPTS)  pnp/process_perfdata.cfg-sample $(DESTDIR)$(SYSCONFDIR)
	$(INSTALL) -m 644 $(INSTALL_OPTS)  pnp/rra.cfg-sample $(DESTDIR)$(SYSCONFDIR)
	$(INSTALL) -m 644 $(INSTALL_OPTS)  pnp/check_commands/check_nwstat.cfg-sample $(DESTDIR)$(SYSCONFDIR)/check_commands
	$(INSTALL) -m 644 $(INSTALL_OPTS)  pnp/pages/web_traffic.cfg-sample $(DESTDIR)$(SYSCONFDIR)/pages

	$(INSTALL) -m 644 $(INSTALL_OPTS)  pnp/npcd.cfg-sample $(DESTDIR)$(SYSCONFDIR)
	
