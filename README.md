# Laravel Challenge: Route Model Binding

**UPDATE 10:42am UTC: Sorry I will stop reviewing the PRs, there's just too many of them, 50+ PRs in 5 hours! Will shoot a separate video in a few days, discussing the results, and for the correct answer check PRs from 1 to 4.**

This is a demo-project which has **intentional** errors around Routing and [Route Model Binding](https://laravel.com/docs/8.x/routing#route-model-binding). 

Your task is to fix those errors, by submitting a Pull Request.

## How to install 

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer install__ (if anyone got problems with composer on windows, try running it like this:  __composer install --ignore-platform-reqs__)
- Run __php artisan key:generate__
- Run __php artisan migrate --seed__ (it has some seeded data for your testing)
- That's it: launch the main URL.

You should see the list of transactions, something like this:

![Homepage](https://laraveldaily.com/wp-content/uploads/2021/07/Screenshot-2021-07-24-at-09.58.37.png)

None of those three buttons View/Export/Duplicate will work. This is exactly the task for you.

---

## Rules: How to perform the tasks

I will be expecting a Pull Request to the `main` branch, containing **all** fixes with completely working project.

If you don't know how to contribute a PR, here's [my video with instructions](https://www.youtube.com/watch?v=vEcT6JIFji0).

**Important**: I will NOT merge the Pull Request, only comment on it, whether it's correct or not.

At the time of writing, I'm not sure how many PRs I will be able to review, or maybe the community will help them. At some point, I will probably stop the challenge and stop accepting PRs, providing the correct answer, which may be actually chosen as one of the PRs.

If you have any questions, or suggestions for the future challenges, please open an Issue.

Good luck!

---

## Task 1. View

### The task

When you click **View**, the error should be something like this:

```
Target class [App\Http\Controllers\Transaction] does not exist.
```

Expected result, after the fix, is a page with task details:

![Transactions show](https://laraveldaily.com/wp-content/uploads/2021/07/Screenshot-2021-07-24-at-10.02.46.png)

### The solution
<details>
    <summary> CLICK ME to see the solution ! </summary>

    The problem is that the Transactions model is *not* imported !

    In the index method, the Transactions are grabbed correctly because of the usage of the full namespace (\App\Models\Transaction).

    However, in the other methods, we are trying to call Transactions class without importing it so PHP tries, by default, to find a class named Transactions in the same namespace as the controller (App\Http\Controllers) which obviously does not exist hence the error => Target class [App\Http\Controllers\Transaction] does not exist.

</details>

---

## Task 2. Export

### The task

You can perform this task only AFTER you finish the Task 1 above, otherwise you will get the same error as Task 1.

When you click **Export**, the error should be something like this:

```
Attempt to read property "name" on null (View: /resources/views/transactions/export.blade.php)
```

Expected result, after the fix, is a page for checking details for export:

![Transactions Export](https://laraveldaily.com/wp-content/uploads/2021/07/Screenshot-2021-07-24-at-10.05.53.png)

### The solution
<details>
    <summary> CLICK ME to see the solution ! </summary>

    At first, you would think that the problem is in the relationship because its trying to read property name on null => meaning the user is not grabbed correctly.

    After some investigation, you would find that the relationship is correctly defined in the model so it's time to check if the transaction is found at all ... and you would be surprised to find that the controller is not receiving any transaction !

    So you go check the route model binding (if you don't know what this means, it's just that instead of passing the transaction's id to the controller, we pass all the transaction)

    And here we find the (intentional) typo in the sense that the controller is expecting a variable named 'transaction' and the route is binding the model to a variable named 'transactions' (see the S)

    => Solution = we remove the 'S' and everything works as expected

</details>

---

## Task 3. Duplicate by UUID

### The task

Duplicate the task should happen with UUID as a URL parameter, it's one of the database fields: `transactions.uuid`.

When you click **Duplicate**, you may have two kinds of errors, randomly:

- Either is would show the **incorrect** transaction, so data from another transaction
- Or it would show the page "404 Not Found"

Expected result, after the fix, is a page for checking details for duplication:

![Transactions Duplicate](https://laraveldaily.com/wp-content/uploads/2021/07/Screenshot-2021-07-24-at-10.09.50.png)

### The solution
<details>
    <summary> CLICK ME to see the solution ! </summary>

    Why do we receive a 404 error ? because Laravel will try to find a transaction by its id but we are giving it a uuid ! So Laravel is comparing uuid to ids which may lead to all sorts of nonesens (404 or worse grab a field that has an id that is equal to that uuid)

    A first solution would be to pass the id directly but that would be kind of cheating as the task specifies that we should duplicate by uuid (imagine a real life scenario where this would make more sense)

    Another solution is to tell Laravel to compare whats is passed in the route with the UUID and not with the id.

    => We can do that in two different ways :

    1. Enforce using uuids in all routes in which case we would need to override the method getRouteKeyName() and returning 'uuid' => the problem with this solution is that we know the other routes need to function with the id 

    2. Specify that for this route, we need to check the uuid and it can easily be done by specifying it in the route definition and that's our solution

</details>
