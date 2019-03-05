#!/usr/bin/ python3
'''
This program is used to generate 1440 permutations using the fact that 2*6!=1440
'''


from __future__ import print_function
from itertools import permutations
import random
#generates 720 permutations(random ways)
a = list(permutations(['vid1','vid2','vid3','vid4','vid5','vid6']))
for i in range(5):
    random.shuffle(a)
for i in a:
    print("(",end="")
    for j in list(i)[:-1]:
        
        print("'"+j+"'",end=",")
    print("'"+list(i)[-1]+"'",end="")

        

    print(")",end=",")
#generates 720 permutations(random ways)
b = list(permutations(['vid2','vid1','vid3','vid4','vid6','vid5']))
for i in range(5):
    random.shuffle(b)
for j in b:
    print("(",end="")
    for k in list(j)[:-1]:
        print("'"+k+"'",end=",")
    print("'"+list(j)[-1]+"'",end="")
    print(")",end=",")


