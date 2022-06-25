#!/bin/sh

PK_NAME=$1
PK_ORD=$2
VERSION=$3
MK_TIME=`date  +"%Y%m%d_%H%M"`


PKINFO_NAME=ASM_${PK_ORD}_${PK_NAME}


#copy file which maked by src to bindir
cp src/busybox-1.19.4/busybox bindir/sbin/ -rf

cp src/registapp/gethardwarecode bindir/usr/bin/ -rf
cp src/registapp/getmodulecount bindir/usr/bin/ -rf
cp src/registapp/getmoduleregist bindir/usr/bin/ -rf
cp src/registapp/makeregistcode bindir/usr/bin/ -rf
cp src/regist/libhardwarecode.so bindir/lib64 -rf

cp src/smsclient/root/usr/lib64/* bindir/lib64 -rf
cp src/smsclient/smsclient bindir/usr/bin -f

cd src/DB
svn update
./make_sql.sh
cd -
#cp src/DB/SQL\ Tools/init_db.sql bindir/asm/etc/config/init_config/init_db.sql  -rf

#copy file which maked by src to bindir
upsqls=`ls src/DB/update/`
for upsql in $upsqls
do
        cp src/DB/update/$upsql/SQL\ Tools/init_db.sql bindir/asm/etc/config/init_config/update/$upsql.sql -rf >/dev/null
	echo "cp $upsql ..."
done

#cp src/DB/update/5.2.6.0001-5.2.6.0002/    bindir/asm/etc/config/init_config/update/5.2.6.0001-5.2.6.0002.sql -rf
#make packageinfofile
PKINFO_PATH=bindir/asm/etc/packageinfo
PKINFO_FNAME=${PKINFO_PATH}/ASM_${PK_ORD}_${PK_NAME}
rm ${PKINFO_PATH}/* -rf
echo VERSION=${VERSION} 	> ${PKINFO_FNAME}
echo MAKETIME=${MK_TIME}	>> ${PKINFO_FNAME}
echo "" >> ${PKINFO_FNAME}
ls  bindir/asm/etc/init.d/ >> ${PKINFO_FNAME}


#make tgz's package
cd bindir
tar -zcvf ../release/${PKINFO_NAME}_${MK_TIME}.TGZ --exclude .svn *
