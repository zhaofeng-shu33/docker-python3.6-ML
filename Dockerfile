FROM python:3.6.7-stretch
WORKDIR /app
COPY . /app
ENV PIP_MIRROR https://pypi.tuna.tsinghua.edu.cn/simple
RUN pip install -i $PIP_MIRROR -r requirements.txt
RUN pip install https://download.pytorch.org/whl/cpu/torch-1.0.0-cp36-cp36m-win_amd64.whl
