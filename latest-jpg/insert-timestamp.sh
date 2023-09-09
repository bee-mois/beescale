#!/bin/bash

# Schleife über alle JPG-Dateien im Ordner
for file in b-cam1_[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]*.jpg; do
  # Extrahiere das Datum und die Uhrzeit aus dem Dateinamen
  datetime=$(echo "$file" | grep -oP '_\K\d{8}\d{6}' | sed 's/^\(.\{8\}\)\(.\{6\}\)$/\1 \2/')
  datum=$(echo "$datetime" | awk '{print $1}')
  uhrzeit=$(echo "$datetime" | awk '{print $2}')

  # Formatiere das Datum und die Uhrzeit um
  formatted_date=$(date -d "$datum" +%Y.%m.%d)
  # Formatiere die Uhrzeit
  formatted_time=$(echo "$uhrzeit" | sed 's/\(..\)\(..\)\(..\)/\1:\2:\3/')

  # Füge das Datum und die Uhrzeit zum Bild hinzu
  convert "$file" -gravity northwest -pointsize 15 -fill black -draw "rectangle 0,0,135,20" -fill white -draw "text 2,2 '$formatted_date $formatted_time'" "$file"
done
