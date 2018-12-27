#!python
# -*- coding: utf-8 -*-
import traceback
import os
import json
import time

import numpy as np
from sklearn import metrics
import model

def main():
    '''load test data and calls the model predict function
    '''
    X_test = np.load('X_test.npy')
    y_test = np.load('y_test.npy')
    start_time = time.time()
    y_predict = model.predict(X_test)
    elapsed_time = time.time() - start_time # in second
    acc = metrics.accuracy_score(y_test, y_predict)
    return {'time': elapsed_time, 'acc': acc}
if __name__=="__main__":
    try:
        result_json = main()
    except Exception as err:
        print('Your code failed to run. Reason :')
        print(err)
        traceback.print_tb(err.__traceback__)
        exit(-1)
    result_str = json.dumps(result_json)
    with open('model/result.txt', 'w') as f:
        f.write(result_str)
