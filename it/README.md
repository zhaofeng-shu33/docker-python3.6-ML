# Deployment
Currently, the OJ system has some limitations. 

1. It can only be deployed on linux server.
1. It uses absolute path and you should follow the path on your server.

## Dependencies

* *Docker CE*: make sure `docker --version` works;
* command line utility [*csvtotable*](https://github.com/vividvilla/csvtotable) installed;
* php fpm

## Steps

1. Make sure the depedencies are solved;
1. download the docker image customized for this project from aliyun mirror(speed up for mainland
```shell
export IMAGE=registry.cn-shenzhen.aliyuncs.com/zhaofeng_shu33/python36ml_it:v1
docker pull $IMAGE 
# give it a short tag name
docker tag $IMAGE python36ml_it:v1
```
1. clone the repository and copy its files to the http server root directory.
```shell
git clone -b it https://github.com/zhaofeng-shu33/docker-python3.6-ML
cp it/ /var/www/html/information_theory
```

