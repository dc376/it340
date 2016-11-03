prefix=/usr/local/nagios
exec_prefix=@exec_prefix@
LOGDIR=/usr/local/nagios/var
CFGDIR=/usr/local/nagios/etc/pnp
BINDIR=/usr/local/nagios/bin
LIBEXECDIR=/usr/local/nagios/libexec
CGIDIR=/usr/local/nagios/sbin
INIT_DIR=/etc/rc.d/init.d
INIT_OPTS=-o root -g root
HTMLDIR=/usr/local/nagios/share/pnp
INSTALL=/bin/install -c
INSTALL_OPTS=-o nagios -g nagios
PERFDATADIR=/usr/local/nagios/share/perfdata

CP=/bin/cp

all html:

clean:

distclean: clean
	-rm -f process_perfdata.pl check_pnp_rrds.pl net2pnp.pl rc.npcd
	-rm -f Makefile

devclean: distclean

install-init: 
	$(INSTALL) -m 755 $(INIT_OPTS) -d $(DESTDIR)$(INIT_DIR)
	$(INSTALL) -m 755 $(INIT_OPTS) rc.npcd $(DESTDIR)$(INIT_DIR)/npcd

install-processperfdata: 
	$(INSTALL) -m 755 $(INSTALL_OPTS) process_perfdata.pl $(DESTDIR)$(LIBEXECDIR)

install-plugins: 
	$(INSTALL) -m 755 $(INSTALL_OPTS) check_pnp_rrds.pl $(DESTDIR)$(LIBEXECDIR)

install-net2pnp:
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(BINDIR)
	$(INSTALL) -m 755 $(INSTALL_OPTS) net2pnp.pl $(DESTDIR)$(BINDIR)

install: 
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(PERFDATADIR)
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(LIBEXECDIR)
	$(MAKE) install-processperfdata
	$(MAKE) install-plugins
	
