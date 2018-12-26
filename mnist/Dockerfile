FROM zhaofengshu33/python36ml:v0
WORKDIR /app
COPY run.py /app
COPY data_packager.py /app
ENV DATA_HOME /app
RUN python data_packager.py
COPY ./dist /app
