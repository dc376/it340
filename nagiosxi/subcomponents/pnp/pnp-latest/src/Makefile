############################
# Makefile for PNP
#
# Last Modified: 11-17-2008
############################


# Source code directories
SRC_INCLUDE=../include

CC=gcc
CFLAGS=-g -O2 -DHAVE_CONFIG_H -DNSCORE

# Compiler flags for use with Valgrind
#CFLAGS=-O0 -g -DHAVE_CONFIG_H -DNSCORE

# Compiler flags for optimization (overrides default)
#CFLAGS=-O3 -Wall -fno-strict-aliasing -Wshadow -Wpointer-arith -Wcast-qual -Wcast-align -Wstrict-prototypes -Wmissing-prototypes -Wnested-externs -DHAVE_CONFIG_H -DNSCORE

# Compiler flags for optimization (complements default)
#CFLAGS_WARN=-Wall -Wshadow -Wpointer-arith -Wcast-qual -Wcast-align -Wstrict-prototypes -Wmissing-prototypes -Wnested-externs
#CFLAGS_DEBUG=-ggdb3 -g3
#CFLAGS_GPROF=-pg
#CFLAGS+=$(CFLAGS_WARN) $(CFLAGS_DEBUG) $(CFLAGS_GPROF)

LDFLAGS=
LIBS=

MOD_LDFLAGS=-shared
MOD_CFLAGS=-fPIC

prefix=/usr/local/nagios
LOGDIR=/usr/local/nagios/var
CFGDIR=/usr/local/nagios/etc/pnp
BINDIR=/usr/local/nagios/bin
LIBEXECDIR=/usr/local/nagios/libexec
CGIDIR=/usr/local/nagios/sbin
INSTALL=/bin/install -c
INSTALL_OPTS=-o nagios -g nagios
STRIP=/bin/strip
DATAROOTDIR=/usr/local/nagios/share/pnp
PERFDATA_SPOOL_DIR=/usr/local/nagios/var/spool/perfdata/

MATHLIBS=-lm

CP=/bin/cp

OBJS=pnpsender.o npcd.o config.o

NPCDOBJS=utils.o config.o logging.o
NPCDHEAD=$(SRC_INCLUDE)/pnp.h $(SRC_INCLUDE)/config.h

OBJDEPS=

all: npcd npcdmod.o

# Required Objects

logging: logging.c $(NPCDHEAD)
	$(CC) $(CFLAGS) -o $@ logging.c

config: config.c $(NPCDHEAD)
	$(CC) $(CFLAGS) -o $@ config.c 

utils: utils.c $(NPCDHEAD)
	$(CC) $(CFLAGS) -o $@ utils.c 

###############################
#
#           PNPSENDER 
#
###############################

pnpsender: pnpsender.c 
	$(CC) $(CFLAGS) -o $@ pnpsender.c 

###############################
#
# 	     NPCD
#
###############################
npcd: npcd.c $(NPCDOBJS) $(NPCDHEAD)
	$(CC) $(CFLAGS) -o $@ npcd.c $(NPCDOBJS) -lpthread

###############################
#
#          NPCDMOD
#
###############################
npcdmod.o: npcdmod.c
	$(CC) $(MOD_CFLAGS) $(CFLAGS) -o npcdmod.o npcdmod.c $(MOD_LDFLAGS) $(LDFLAGS) $(LIBS) -fPIC

###############################
#
#        Cleanups
#
###############################

clean:
	-rm -f pnpsender *.o 
	-rm -f npcd *.o 
	-rm -f *~ *.*~

distclean: clean
	-rm -f Makefile

devclean: distclean


###############################
#
#         Install
#
################################

install:
	$(MAKE) install-basic
	$(MAKE) strip-post-install

install-unstripped:
	$(MAKE) install-basic

install-basic:
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(BINDIR)
	$(INSTALL) -m 755 $(INSTALL_OPTS) -d $(DESTDIR)$(PERFDATA_SPOOL_DIR)
	$(INSTALL) -m 754 $(INSTALL_OPTS) npcd $(DESTDIR)$(BINDIR)
	$(INSTALL) -m 754 $(INSTALL_OPTS) npcdmod.o $(DESTDIR)$(BINDIR)

strip-post-install:
	$(STRIP) $(DESTDIR)$(BINDIR)/npcd
	$(STRIP) $(DESTDIR)$(BINDIR)/npcdmod.o
