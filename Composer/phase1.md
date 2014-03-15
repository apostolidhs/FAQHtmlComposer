Τι συμβαίνει με τους escaped χαρακτήρες μέσα στα strings; Μπορεί ένα string να περιέχει πραγματικούς ειδικούς χαρακτήρες πχ. newlines και tabs; 4
-------------------------
Τα strings που περιέχουν escaped χαρακτήρες, θα πρέπει να τους αναγνωρίζουν ως ειδικούς χαρακτήρες, δηλαδή το string “hello world\n”, θα περιέχει τους χαρακτήρες h, e, l, l, ..., d, newline και όχι τους χαρακτήρες h, e, l, l, ..., d, \, n. Το ίδιο βέβαια ισχύει και για τους άλλους escaped χαρακτήρες. Από εκεί και πέρα ένα string μπορεί να περιέχει έναν πραγματικό χαρακτήρα tab αντί για τον escaped \t, αλλά η χρήση ενός πραγματικού χαρακτήρα newline είναι προαιρετική. Η χρήση ενός πραγματικού χαρακτήρα newline μέσα σε strings, επιτρέπει στους χρήστες να δημιουργούν μεμονωμένα strings που καταλαμβάνουν παραπάνω από μία γραμμές (multi-line strings) εξυπηρετώντας μόνο αισθητικούς “σκοπούς”.