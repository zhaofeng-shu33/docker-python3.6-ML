FROM zhaofengshu33/python36ml:v0
RUN wget http://deb.debian.org/debian/pool/main/u/unzip/unzip_6.0.orig.tar.gz && \
    tar -vxzf unzip_6.0.orig.tar.gz && \
    cd unzip60 && \    
    cp unix/Makefile ./ && \
    make generic && \
    make install
WORKDIR /dist
