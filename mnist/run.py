#!/usr/bin/env python3
# -*- coding: utf-8 -*-
import traceback
import os

import numpy as np
from sklearn import metrics
import model

def main():
    '''load test data and calls the model predict function
    '''
    X_test = np.load('X_test.npy')
    y_test = np.load('y_test.npy')
    y_predict = model.predict(X_test)
    return metrics.accuracy_score(y_test, y_predict)
    
if __name__=="__main__":
    try:
        acc = main()
        print(acc)
    except Exception as err:
        print('Your code failed to run. Reason :')
        print(err)
        traceback.print_tb(err.__traceback__)
