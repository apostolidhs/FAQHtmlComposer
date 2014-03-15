Στη σημασιολογία της γλώσσας αναφέρεται ένας reference counter για τα αντικείμενα τύπου πίνακα. Πρέπει να υλοποιηθεί σε αυτήν τη φάση;
-------------------------
Όχι. Δεν είναι δυνατόν να ξέρουμε το reference count ενός πίνακα at compile time. Αυτό θα γίνει at run-time.
=========================
Στην Alpha επιτρέπεται ή απαγορεύεται η έκφραση x % y, όταν το x ή y δεν είναι ακέραιος αριθμός; Πώς μπορούμε να υλοποιήσουμε την πράξη %, αφού ο gcc δεν μπορεί να εφαρμόσει τον τελεστή % σε doubles;
-------------------------
Το specification της γλώσσας λέει ότι ο τελεστής **%**, μπορεί να εφαρμοστεί σε αντικείμενα τύπου **number**. Επομένως θα μπορεί ο τελευταίος να εφαρμόζεται και σε μη ακέραιους αριθμούς, αρκεί αυτοί να μετατρέπονται πρώτα σε ακέραιους.
Έτσι, για να υπολογιστεί το αποτέλεσμα της πράξης **r = x % y**, θα πρέπει να μετατραπούν πρώτα οι x, y σε ακέραιους και το τελικό αποτέλεσμα σε **double**, δηλαδή:
```javascript
double r = ((int) x) % ((int) y);
```
=========================
Πού και πώς χρησιμοποιείται το πεδίο label του struct quad;
-------------------------
Στο πεδίο label του **struct quad**, αποθηκεύουμε μόνο το index (στον πίνακα των quads), στο οποίο θα κάνει (ενδεχομένως) **jump** μία εντολή διακλάδωσης. Σε όλες τις άλλου τύπου εντολές το πεδίο index δεν χρησιμοποιείται. Φυσικά το index μιας συγκεκριμένης εντολής ενδιάμεσου κώδικα, ορίζεται εμμέσως από την θέση της στον πίνακα των quads.
=========================
Γιατί υπάρχει ο pointer expr* next στο struct expr;
-------------------------
Ο pointer expr* **next**, υπάρχει στο **struct expr**, ώστε να μπορούμε να φτιάχνουμε άμεσα απλές λίστες από αντικείμενα τύπου **expr**. Αυτό είναι χρήσιμο γιατί μπορούμε να χρησιμοποιήσουμε τον ίδιο τύπο **(expr)** και για το μη τερματικό σύμβολο **elist** (expression list) που εμφανίζεται και χρησιμοποιείται στους κανόνες call και tablemake.
=========================
Γιατί χρειάζεται στον κανόνα του assignexpr (l-value '=' expr) και στους κανόνες προθεματικής αύξησης και μείωσης ενός l-value (++l-value, --l-value) να προστεθεί μία επιπλέον εντολή emit στο τέλος;
-------------------------
Αυτή η επιπλέον εντολή ανάθεσης τιμής στους παραπάνω κανόνες, ενώ Δεν φαίνεται εκ πρώτης όψεως να συμβάλλει στην λειτουργικότητα του προγράμματος, είναι απαραίτητη για την διατήρηση της ορθής σημασιολογίας της γλώσσας σε περίπτωση που ο προγραμματιστής χρησιμοποιήσει το ίδιο l-value, αλλάζοντάς το, σε δύο ή περισσότερα σημεία ενός expression list.
πχ.
```javascript
i = 0;
t = [ ++i, i = 1821, --i, i = 8 ];
```
έτσι ο πίνακας t, για να είναι “σωστός”, σύμφωνα πάντα με την σημασιολογία της γλώσσας, θα πρέπει να είναι ισοδύναμος με τον:
```javascript
t_correct = [ 1, 1821, 1820, 8 ];
```
αφού σύμφωνα με τη γλώσσα, τα expression lists γίνονται evaluate από τα αριστερά προς τα δεξιά. Είναι προφανές ότι εάν Δεν υπήρχε αυτή η τελευταία εντολή ανάθεσης τιμής στους παραπάνω γραμματικούς κανόνες, ο ενδιάμεσος κώδικας που θα παραγόταν, θα ανάγκαζε τον t να αρχικοποιηθεί τελικά με τις τιμές:
```javascript
t_wrong = [ 8, 8, 8, 8 ];
```
αφού, σύμφωνα με την syntax-directed παραγωγή ενδιάμεσου κώδικα, πρώτα γίνεται η αποτίμηση όλων των εκφράσεων στο expression list και μετά γίνεται η ανάθεσή τους με **tablesetelem**.
=========================
Η παραπάνω εντολή που γίνεται emit, διορθώνει το “πρόβλημα” της left-to-right αποτίμησης των expression lists για assignments και increments / decrements. Όμως τι γίνεται όταν ένας πίνακας αρχικοποιηθεί ως t = [ ++i, i, i = 8 ] ;
-------------------------
Όντος σε αυτήν την περίπτωση το δεύτερο στοιχείο του πίνακα θα αρχικοποιηθεί στην τιμή “8”, που σίγουρα δεν είναι κάτι που θα περίμενε ο προγραμματιστής σε αυτήν την περίπτωση. Όμως, θα μπορούσε κάποιος να διαφωνήσει σχετικά με το εάν σε ένα l-value που εμφανίζεται στο initialization list ενός πίνακα (ή των παραμέτρων μιας συνάρτησης) θα πρέπει να αποδίδεται η τελική του τιμή μετά από ολόκληρη την αποτίμηση των εκφράσεων ή η τιμή που έχει εκείνη τη στιγμή. Έτσι, δεδομένης της συγκεκριμένης ασάφειας και δεδομένου ότι είναι πιο “καθαρή” η λύση της ανάθεσης της τιμής ενός l-value όταν αποτιμηθούν όλες οι εκφράσεις που το περιέχουν, είναι αποδεκτές και οι δύο προσεγγίσεις στην υλοποίηση της γλώσσας.