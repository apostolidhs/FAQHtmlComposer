Πώς γίνεται η αναζήτηση (lookup) ενός συμβόλου μέσα στο symbol table του μεταφραστή;
-------------------------
Προκειμένου να βρεθεί (να γίνει resolve) ένα σύμβολο που εμφανίζεται σε μία συνάρτηση, θα πρέπει η διαδικασία της αναζήτησης να περάσει από τα εξής στάδια (η διαδικασία σταματάει σε οποιοδήποτε στάδιο μόλις βρεθεί το σύμβολο):
*    Αναζήτηση του συμβόλου ανάμεσα στις τοπικές μεταβλητές, οποιουδήποτε τύπου, της συνάρτησης
*    Αναζήτηση του συμβόλου ανάμεσα στις παραμέτρους, οποιουδήποτε τύπου, της συνάρτησης
*    Αναζήτηση του συμβόλου σε όλα τα επίπεδα (scopes) που είναι μικρότερα του τρέχοντος και μεγαλύτερα του καθολικού (global) ανάμεσα μόνο στις συναρτήσεις που έχουν οριστεί σε αυτά
*    Αναζήτηση του συμβόλου ανάμεσα σε όλα τα σύμβολα, οποιουδήποτε τύπου, που έχουν οριστεί στο καθολικό επίπεδο
Εάν αποτύχουν όλα τα στάδια τότε το προς αναζήτηση σύμβολο δεν υπάρχει και θα πρέπει να εισαχθεί. Τέλος εάν το προς αναζήτηση σύμβολο ακολουθεί το token “::”, η αναζήτησή του θα πρέπει να γίνει αναγκαστικά στο καθολικό επίπεδο (βλέπε κανόνα 4).
