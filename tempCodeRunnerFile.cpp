// #include <bits/stdc++.h>
#include <iostream>
#include <vector>

using namespace std;

int birthdayCakeCandles(vector<int> candles) {
    for ( int i = 0; i < candles.size(); i++) {
        for ( int j = i+1; j< candles.size() - 1; j++) {
            if ( candles[i] < candles[j]) {
                int tmp = candles[i];
                candles[i] = candles[j];
                candles[j] = tmp;
            }
        }
    }
    int count = 0;
    for ( int i = 0; i< candles.size(); i++) {
        count ++;
        if ( candles[i] > candles[i++] ) {
            break;
        }
    }
    cout << count;
    return count;
}

int main {
    int n;
    cin >> n;
    vector<int> candles(n);
    for ( int i = 0; i< n; i++) {
        cin >> candles[i];
    }
}