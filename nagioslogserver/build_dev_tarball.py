#!/usr/bin/env python

import os
import shutil
import tarfile

ABSPATH = os.path.abspath(__file__)
DIRNAME = os.path.dirname(ABSPATH) 
os.chdir(DIRNAME)

shutil.rmtree('/tmp/nagioslogserver-devel', ignore_errors=True)

os.system('svn up')
os.system('svn export %s /tmp/nagioslogserver-devel' % DIRNAME)

tar = tarfile.open('/tmp/nagioslogserver-devel.tar.gz', 'w:gz')
tar.add('/tmp/nagioslogserver-devel', arcname='nagioslogserver')
tar.close()
