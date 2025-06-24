<?php $__env->startSection('dashboard-content'); ?>
<style>
    .details-container {
        background-color: #f4f6f8;
        padding: 20px;
        border-radius: 8px;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 10px;
    }

    .return-info {
        flex: 1;
    }

    .return-info p {
        margin: 5px 0;
        color: #333;
    }

    .return-info a {
        color: #2979FF;
        text-decoration: none;
    }

    .return-info a:hover {
        text-decoration: underline;
    }

    .buttons {
        display: flex;
        gap: 10px;
        align-self: flex-start;
        margin-bottom: 5px;
    }

    button {
        padding: 10px 20px;
        background-color: orange;
        border: none;
        color: #fff;
        cursor: pointer;
        border-radius: 5px;
        font-weight: bold;
    }

    button.download-btn {
        background-color: #a9a9a9;
    }

    button:hover {
        background-color: #e69500;
    }

    button.download-btn:hover {
        background-color: #888;
    }

    .refund-info {
        flex-basis: 100%;
        text-align: right;
        font-size: 12px;
        color: #888;
        margin-top: -40px;
    }

    .progress-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 0 15px; /* Add padding for responsiveness */
        gap: 10px;

    }

    .progressbar {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 40px;
        margin-top: 40px;
    }

    .progressbar::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background-color: #ddd;
        transform: translateY(-50%);
        z-index: -1;
    }

    .progress {
        position: absolute;
        top: 50%;
        left: 0;
        height: 2px;
        background-color: green;
        transform: translateY(-50%);
        width: 0%;
        transition: width 0.3s ease;
    }

    .progress-step {
        width: 20px;
        height: 20px;
        background-color: #ddd;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }

    .progress-step::before {
        content: attr(data-title);
        position: absolute;
        top: 35px; /* Position the text below the bar */
        width: 120px; /* Adjust width for text */
        text-align: center;
        font-size: 9px;
        color: #333;
    }

    /* Active steps */
    .progress-step-active {
        background-color: green;
    }

    /* Button styles */
    .btn {
        background-color: green;
        border: none;
        padding: 7px 12px;
        color: white;
        cursor: pointer;
        border-radius: 5px;
        margin: 5px;
    }

    .btn:disabled {
        background-color: #ddd;
        cursor: not-allowed;
    }

    @media screen and (max-width: 600px) {
        .progress-step::before {
            font-size: 8px;
            width: 90px;
        }

        .details-container {
            flex-direction: column; /* Stack elements on smaller screens */
        }

        .buttons {
            flex-direction: column; /* Stack buttons vertically */
        }
    }

    .notification {
        background-color: #f0f0f0;
        padding: 20px;
        margin-bottom: 20px;
        border-left: 4px solid #cccccc;
        border-radius: 5px;
        width: 80%;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Apply a light shadow to the notification */
        gap: 10px;
        margin-top: 15px;
    }

    .notification p {
        font-size: 11px;
        color: #333333;
    }
    .review-product {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        margin-top: 15px;
    }

    .review-product-info {
        flex-grow: 1;
    }
</style>

<h4 class="py-2 px-2">Return Details</h4>
<div class="details-container" id="print-section">
    <div class="return-info">
        <p>Returned on <span id="return-date"></span></p>
        <p>Order <a href="#">#209958310692054</a></p>
        <p>RA Code: <span>RN502430864292054</span></p>
    </div>
    <div class="buttons">
        <button class="print-btn" onclick="printPage()">PRINT</button>
        <button class="download-btn" onclick="downloadPDF()">DOWNLOAD</button>
    </div>
    <div class="refund-info">
        <p>Refund via Points</p>
    </div>
</div>

<div class="progress-container">
    <div class="progressbar">
        <div class="progress" id="progress"></div>
        <div class="progress-step" data-title="1. We have received your return request"></div>
        <div class="progress-step" data-title="2. Pending Pick Up"></div>
        <div class="progress-step" data-title="3. Your return package is on its way to our logistics facility"></div>
        <div class="progress-step" data-title="4. Return Package Received"></div>
        <div class="progress-step" data-title="5. Refund processing"></div>
        <div class="progress-step" data-title="6. Your refund has been approved"></div>
    </div>
    <div class="buttons">
        <button class="btn" id="prev">Previous</button>
        <button class="btn" id="next">Next</button>
    </div>
</div>
<div class="notification">
    <p style="font-size: 12px; color: #888; display: inline-block; margin-right: 10px;">
        <strong>2024-09-27 17:02:55</strong>
    </p>
    <span style="font-size: 12px; color: #333; display: inline-block;">
        The courier will contact you to arrange pick-up for the item within 5-7 working days from the date of return requested. Please pack the return product(s) securely and stick the return shipping label or write the tracking number and order number on the outer side of the package.
    </span>
</div>


<div class="review-product">
    <div class="col-md-1 d-flex align-items-center">
        <div style="margin-right: 15px;">
            <a href="#"><img src="\assets\images\d (1).png" alt="Product Image" width="50" height="auto"></a>
        </div>
    </div>

    <div class="col-md-3 d-flex flex-column justify-content-center" style="font-size: 13px;">
        <span style="font-weight: 600;">Sara Off Red Strape Dress</span>
        <div>
            <span class="me-2">Color: <span style="font-weight: 600;">Yellow</span></span> |
            <span class="me-2 ms-2">Size: <span style="font-weight: 600;">M</span></span> |
            <span class="ms-2">Qty: <span style="font-weight: 600;">1</span></span>
        </div>
        <h6 class="mt-2" style="font-size: 13px;font-weight: bold;">Rs 3400</h6>
    </div>
    <p style="font-size:13px;"><strong style="margin-left: 60px;">Reason:</strong> Item does not match description or picture</p>
</div>

<script>
    // Print function
    function printPage() {
        var printContents = document.getElementById('print-section').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    // Progress bar functionality
    const progress = document.getElementById('progress');
    const prevBtn = document.getElementById('prev');
    const nextBtn = document.getElementById('next');
    const steps = document.querySelectorAll('.progress-step');

    let currentStep = 1;

    nextBtn.addEventListener('click', () => {
        currentStep++;
        if (currentStep > steps.length) {
            currentStep = steps.length;
        }
        updateProgress();
    });

    prevBtn.addEventListener('click', () => {
        currentStep--;
        if (currentStep < 1) {
            currentStep = 1;
        }
        updateProgress();
    });

    function updateProgress() {
        steps.forEach((step, idx) => {
            if (idx < currentStep) {
                step.classList.add('progress-step-active');
            } else {
                step.classList.remove('progress-step-active');
            }
        });

        const progressActive = document.querySelectorAll('.progress-step-active');
        progress.style.width = ((progressActive.length - 1) / (steps.length - 1)) * 100 + '%';

        prevBtn.disabled = currentStep === 1;
        nextBtn.disabled = currentStep === steps.length;
    }

    updateProgress();
</script>
<!-- Include jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    window.addEventListener("DOMContentLoaded", () => {
        const now = new Date();
        const date = now.toISOString().split("T")[0];      // YYYY-MM-DD
        const time = now.toTimeString().split(" ")[0];     // HH:MM:SS
        document.getElementById("return-date").textContent = `${date} ${time}`;
    });

    async function downloadPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        const dateSpan = document.getElementById("return-date");
        const dateText = dateSpan ? dateSpan.textContent.trim() : "(no date)";
        const locationText = document.querySelector(".return-location")?.textContent.trim() ?? "";

        const fullText = `Returned on ${dateText} ${locationText}`;

        console.log("PDF Content:", fullText); // Optional: debug

        doc.text(fullText, 20, 30);
        doc.save("generated.pdf");
    }
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('member_dashboard.user_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Desktop\OMC\OMCNEW\resources\views/member_dashboard/returns-details.blade.php ENDPATH**/ ?>