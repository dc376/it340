#ifndef HEADER_DH_H
#include <openssl/dh.h>
#endif
DH *get_dh512()
	{
	static unsigned char dh512_p[]={
		0x84,0x0B,0x29,0x34,0x0A,0x24,0xDA,0xA6,0xCD,0x20,0x32,0xDF,
		0xE3,0xB3,0x15,0x83,0x55,0x60,0x2F,0x2A,0x87,0xE5,0xC1,0x0E,
		0x12,0x32,0xC6,0xF2,0x80,0x4D,0x8B,0x17,0x02,0xFF,0x35,0x8B,
		0x21,0x52,0xFA,0x60,0x39,0x33,0x2E,0xED,0x95,0x3B,0x7F,0x12,
		0xCD,0x32,0xF5,0xC7,0x48,0xEC,0xA4,0xB4,0x8F,0xE5,0x88,0x81,
		0xA7,0xEF,0x3D,0x7B,
		};
	static unsigned char dh512_g[]={
		0x02,
		};
	DH *dh;

	if ((dh=DH_new()) == NULL) return(NULL);
	dh->p=BN_bin2bn(dh512_p,sizeof(dh512_p),NULL);
	dh->g=BN_bin2bn(dh512_g,sizeof(dh512_g),NULL);
	if ((dh->p == NULL) || (dh->g == NULL))
		{ DH_free(dh); return(NULL); }
	return(dh);
	}
