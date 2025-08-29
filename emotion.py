import cv2
from deepface import DeepFace
import time
from collections import Counter

# Mapping detected emotions to mood-based songs
mood_songs = {
    "happy": "🎵 'Happy' by Pharrell Williams",
    "sad": "🎵 'Someone Like You' by Adele",
    "angry": "🎵 'In the End' by Linkin Park",
    "surprise": "🎵 'Can't Stop the Feeling' by Justin Timberlake",
    "fear": "🎵 'Fearless' by Taylor Swift",
    "disgust": "🎵 'Bad Guy' by Billie Eilish",
    "neutral": "🎵 'Weightless' by Marconi Union",
}

# Load face cascade classifier
face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')

# Start capturing video
cap = cv2.VideoCapture(0)

start_time = time.time()
emotions_list = []

print("Scanning for 3 seconds...")

while True:
    ret, frame = cap.read()
    if not ret:
        break

    gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    rgb_frame = cv2.cvtColor(gray_frame, cv2.COLOR_GRAY2RGB)

    faces = face_cascade.detectMultiScale(gray_frame, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))

    for (x, y, w, h) in faces:
        face_roi = rgb_frame[y:y + h, x:x + w]

        try:
            result = DeepFace.analyze(face_roi, actions=['emotion'], enforce_detection=False)
            emotion = result[0]['dominant_emotion']
            emotions_list.append(emotion)

            cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 0, 255), 2)
            cv2.putText(frame, emotion, (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 0, 255), 2)

        except:
            cv2.putText(frame, "Face not detected", (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 0, 255), 2)

    cv2.imshow('Real-time Emotion Detection', frame)

    # Stop after 3 seconds
    if time.time() - start_time > 3:
        break

    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()

# Determine the most common emotion
if emotions_list:
    dominant_mood = Counter(emotions_list).most_common(1)[0][0]
    suggested_song = mood_songs.get(dominant_mood, "No song suggestion available")
    print(f"Detected Mood: {dominant_mood}")
    print(f"Suggested Song: {suggested_song}")
else:
    print("No face detected. Try again.")
