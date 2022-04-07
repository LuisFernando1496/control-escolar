import os
import random
import sys
array = ['Aprende vim papa 👔','Mi rey Hay mas culos que estrellas.','Pero que haya morras chidas', 'EFE', 'Asu Makina','Aguanta Carnal,Estoy agarrando señal!!']
message = ''
branch = ''
def autopush():
    os.system('git add .')
    os.system(f'git commit -m "{message}"')
    os.system(f'git push origin {branch}')
    print('Ready!!! 😈')
    print(f'Remember: "{array[random.randint(0,len(array)-1)]}"')
if len(sys.argv) >= 3:
    message = sys.argv[1]
    branch = sys.argv[2]
    autopush()
else:
    message = input('What did you do?, dude🎤 : ')
    branch = input('What branch would use Dude? 🤨: ')
    autopush()

