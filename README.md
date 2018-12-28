# docker-python3.6-ML
This branch is used as the  online judge of the final project of the Course **Information Theory**(TBSI 2018 Autumn).
The name of the sandbox is `zhaofengshu33/python36ml_it:v1`, which has `tensorflow`, `keras`, `torch`, `pandas` installed and is available 
from [docker hub](https://cloud.docker.com/u/zhaofengshu33/repository/docker/zhaofengshu33/python36ml_it).

# Purpose
Test data should be kept secret as the prediction accuracy on test data influences the scoring of students. As a result, we use
a server to keep the test data and run the submitted codes on the server to produce the results. The final project supposes you 
have 100,000 RMB initially, you need to design an automatic portfolio strategy to maximize stock profit with the test data at every
minute. The strategy contains many aspects, such as what stocks to invest and when to invest. Besides,
this part should involve information theory idea. The API will be released later to evaluate your investment
strategy using the testing data.

# Features
We implement an OJ system which has the following features:
* Flexibility: the user submitted codes are treated as a Python package to be called from main program. 
* Completeness: many logic errors specific to the judging problems are considered and handled specifically.
* Safety: sandbox is used to run the user code, preventing the malicious user from harming the server.
* Easy management: user can interact with the OJ system by API described in our [wiki](https://github.com/zhaofeng-shu33/docker-python3.6-ML/wiki/Information_Theory_Project_Check).
* Beautiful Interface: the competition results are shown on the index page.

# Developer
1. feima
1. hlwang
1. [zhaofeng-shu33](https://github.com/zhaofeng-shu33)

