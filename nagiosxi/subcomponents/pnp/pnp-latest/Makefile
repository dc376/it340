###############################
# Makefile for PNP
#
# Last Modified: 12-10-2006
###############################


# Source code directories
SRC_BASE=./src
SRC_SHARE=./share
SRC_SCRIPTS=./scripts
SRC_CONFIG=./sample-config
SRC_MAN=./man
SRC_CONTRIB=./contrib

CC=gcc
CFLAGS=-g -O2 -DHAVE_CONFIG_H
LDFLAGS= 

prefix=/usr/local/nagios
LOGDIR=/usr/local/nagios/var
CFGDIR=/usr/local/nagios/etc/pnp
BINDIR=/usr/local/nagios/bin
LIBEXECDIR=/usr/local/nagios/libexec
CGIDIR=/usr/local/nagios/sbin
INSTALL=/bin/install -c
INSTALL_OPTS=-o nagios -g nagios
DATAROOTDIR=/usr/local/nagios/share/pnp

CP=/bin/cp

none:
	@echo "Please supply a command line argument (i.e. 'make all').  Other targets are:"
	@echo "   clean"
	@echo "   install install-init install-config install-processperfdata install-html fullinstall"
	@echo "   install-plugins"

# FreeBSD make does not support -C option, so we'll use the Apache style... (patch by Stanley Hopcroft 12/27/1999)

all:
	cd $(SRC_BASE) && $(MAKE)
	cd $(SRC_SHARE) && $(MAKE)
	cd $(SRC_SCRIPTS) && $(MAKE)

	@echo ""
	@echo "*** Compile finished ***"
	@echo ""
	@echo "  make install"
	@echo "     - This installs the main program and HTML files"
	@echo ""
	@echo "Enjoy."
	@echo ""

pnpsender:
	cd $(SRC_BASE) && $(MAKE)

scripts:
	cd $(SRC_SCRIPTS) && $(MAKE)

share:
	cd $(SRC_SHARE) && $(MAKE)

clean:
	cd $(SRC_BASE) && $(MAKE) $@
	cd $(SRC_SHARE) && $(MAKE) $@
	cd $(SRC_SCRIPTS) && $(MAKE) $@
	cd $(SRC_CONFIG) && $(MAKE) $@
	cd $(SRC_MAN) && $(MAKE) $@
	-rm -f *.cfg core
	-rm -f *~ *.*~ */*~ */*.*~
	-rm -f config.log config.status config.cache

distclean: 
	cd $(SRC_BASE) && $(MAKE) $@
	cd $(SRC_SHARE) && $(MAKE) $@
	cd $(SRC_SCRIPTS) && $(MAKE) $@
	cd $(SRC_CONFIG) && $(MAKE) $@
	cd $(SRC_MAN) && $(MAKE) $@
	-rm -f *.cfg core
	-rm -f *~ *.*~ */*~ */*.*~
	-rm -f config.log config.status config.cache
	rm -f Makefile include/stamp-h1 include/config.h config.status config.log
	rm -f sample-config/xinetd.pnp.sample sample-config/misccommands.sample
	rm -f subst summary
	rm -f $(SRC_CONTRIB)/verify_pnp_config

devclean: distclean

install-html:
	cd $(SRC_SHARE) && $(MAKE) install

install-base:
	cd $(SRC_BASE) && $(MAKE) install

install-processperfdata:
	cd $(SRC_SCRIPTS) && $(MAKE) install

install-init:
	cd $(SRC_SCRIPTS) && $(MAKE) install-init

install-config:
	cd $(SRC_CONFIG) && $(MAKE) install-config

install-plugins:
	cd $(SRC_SCRIPTS) && $(MAKE) install-plugins

install:
	cd $(SRC_BASE) && $(MAKE) $@
	cd $(SRC_SHARE) && $(MAKE) $@
	cd $(SRC_SCRIPTS) && $(MAKE) $@
	cd $(SRC_CONFIG) && $(MAKE) $@
	$(MAKE) install-basic

install-unstripped:
	cd $(SRC_BASE) && $(MAKE) $@
	cd $(SRC_SHARE) && $(MAKE) $@
	cd $(SRC_SCRIPTS) && $(MAKE) $@
	$(MAKE) install-basic

install-basic:

	@echo ""
	@echo "*** Main program, Scripts and HTML files installed ***"
	@echo ""
	@echo "Please run 'make install-config' to install sample"
	@echo "configuration files"
	@echo ""
	@echo "Please run 'make install-init' if you want to use"
	@echo "BULK Mode with NPCD"
	@echo ""
	@echo ""
	@echo ""

fullinstall: install install-init install-config

