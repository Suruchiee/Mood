import cv2
from deepface import DeepFace
import time
from collections import Counter

face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')
cap = cv2.VideoCapture(0)

start_time = time.time()
detected_emotions = []

while True:
    ret, frame = cap.read()
    if not ret:
        break

    gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    rgb_frame = cv2.cvtColor(gray_frame, cv2.COLOR_GRAY2RGB)
    faces = face_cascade.detectMultiScale(gray_frame, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))

    for (x, y, w, h) in faces:
        face_roi = rgb_frame[y:y + h, x:x + w]
        result = DeepFace.analyze(face_roi, actions=['emotion'], enforce_detection=False)
        detected_emotions.append(result[0]['dominant_emotion'])

    if time.time() - start_time >= 3:
        break

cap.release()
cv2.destroyAllWindows()

if detected_emotions:
    most_common = Counter(detected_emotions).most_common(1)[0][0]
    print(most_common.lower())
else:
    print("neutral")
