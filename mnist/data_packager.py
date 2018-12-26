import os
import numpy as np
from sklearn.datasets import fetch_openml
if __name__=="__main__":
    X, y = fetch_openml('mnist_784', version=1, return_X_y=True)
    X = X / 255.

    # rescale the data, use the traditional train/test split
    X_train, X_test = X[:60000], X[60000:]
    y_train, y_test = y[:60000], y[60000:]
    if not(os.path.exists('dist')):
        os.mkdir('dist')
    np.save('dist/X_train.npy', X_train)
    np.save('X_test.npy', X_test)
    np.save('dist/y_train.npy', y_train)
    np.save('y_test.npy', y_test)
