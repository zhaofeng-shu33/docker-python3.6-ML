FROM python:3.6.7-stretch
WORKDIR /app
COPY ./app
ENV PIP_MIRROR https://pypi.tuna.tsinghua.edu.cn/simple
RUN pip -i $PIP_MIRROR -r requirements.txt
