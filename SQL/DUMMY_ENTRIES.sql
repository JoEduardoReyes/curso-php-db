INSERT INTO incomes (payment_method, type, date, amount, description)
VALUES (1, 1, '2023-06-01 10:00:00', 1500.00, 'Salary payment for June'),
       (2, 2, '2023-06-05 15:30:00', 250.00, 'Freelance project'),
       (3, 1, '2023-06-10 12:00:00', 2000.00, 'Bonus payment'),
       (1, 3, '2023-06-15 09:00:00', 500.00, 'Rental income'),
       (2, 2, '2023-06-20 14:45:00', 300.00, 'Part-time job payment');
INSERT INTO withdrawals (payment_method, type, date, amount, description)
VALUES (1, 1, '2023-06-02 11:00:00', 100.00, 'Grocery shopping'),
       (2, 2, '2023-06-06 16:00:00', 50.00, 'Movie tickets'),
       (3, 3, '2023-06-11 13:00:00', 75.00, 'Restaurant bill'),
       (1, 1, '2023-06-16 10:00:00', 200.00, 'Utilities payment'),
       (2, 2, '2023-06-21 15:00:00', 150.00, 'Gym membership fee');
