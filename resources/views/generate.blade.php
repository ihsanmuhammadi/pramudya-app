<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Generate PDF') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Success Message --}}
                <div id="successMessage" class="bg-green-100 border border-green-300 text-green-800 p-4 rounded mb-4 hidden">
                    PDF generated successfully! Check your downloads folder.
                </div>

                {{-- Form --}}
                <form id="pdfForm">
                    <div class="grid gap-4">
                        <div>
                            <label for="companyName" class="block text-sm font-medium text-gray-700">Company Name *</label>
                            <input type="text" id="companyName" name="companyName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label for="documentTitle" class="block text-sm font-medium text-gray-700">Document Title *</label>
                            <input type="text" id="documentTitle" name="documentTitle" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label for="recipientName" class="block text-sm font-medium text-gray-700">Recipient Name *</label>
                            <input type="text" id="recipientName" name="recipientName" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label for="documentDate" class="block text-sm font-medium text-gray-700">Document Date *</label>
                            <input type="date" id="documentDate" name="documentDate" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        <div>
                            <label for="documentContent" class="block text-sm font-medium text-gray-700">Document Content *</label>
                            <textarea id="documentContent" name="documentContent" rows="6" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-center mt-6 space-x-4">
                        <button type="button" onclick="previewDocument()" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                            Preview Document
                        </button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Generate PDF
                        </button>
                    </div>
                </form>

                {{-- Preview --}}
                <div class="mt-10 border-t pt-6 hidden" id="previewSection">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Document Preview</h3>
                    <div id="previewContent" class="bg-gray-100 p-4 rounded border border-gray-300 text-sm leading-relaxed">
                        <!-- Preview content will be inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- JS Libraries --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    {{-- JS Script --}}
    <script>
        document.getElementById('documentDate').valueAsDate = new Date();

        function previewDocument() {
            const companyName = document.getElementById('companyName').value;
            const documentTitle = document.getElementById('documentTitle').value;
            const recipientName = document.getElementById('recipientName').value;
            const documentDate = document.getElementById('documentDate').value;
            const documentContent = document.getElementById('documentContent').value;

            if (!companyName || !documentTitle || !recipientName || !documentDate || !documentContent) {
                alert('Please fill in all required fields before previewing.');
                return;
            }

            const formattedDate = new Date(documentDate).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const previewHTML = `
                <div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; line-height: 1.6;">
                    <div style="text-align: center; margin-bottom: 30px;">
                        <h1 style="color: #1f2937; margin-bottom: 10px;">${companyName}</h1>
                        <div style="height: 2px; background-color: #3b82f6; margin: 0 auto; width: 100px;"></div>
                    </div>
                    <div style="text-align: right; margin-bottom: 30px;">
                        <strong>Date:</strong> ${formattedDate}
                    </div>
                    <div style="text-align: center; margin-bottom: 30px;">
                        <h2 style="color: #374151; text-decoration: underline;">${documentTitle}</h2>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <strong>To:</strong> ${recipientName}
                    </div>
                    <div style="margin-bottom: 30px; text-align: justify;">
                        ${documentContent.replace(/\n/g, '<br>')}
                    </div>
                    <div style="margin-top: 50px;">
                        <div style="border-top: 1px solid #000; width: 200px; margin-bottom: 5px;"></div>
                        <div><strong>Authorized Signature</strong></div>
                        <div style="margin-top: 10px;">${companyName}</div>
                    </div>
                </div>
            `;

            document.getElementById('previewContent').innerHTML = previewHTML;
            document.getElementById('previewSection').style.display = 'block';
            document.getElementById('previewSection').scrollIntoView({ behavior: 'smooth' });
        }

        document.getElementById('pdfForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const companyName = document.getElementById('companyName').value;
            const documentTitle = document.getElementById('documentTitle').value;
            const recipientName = document.getElementById('recipientName').value;
            const documentDate = document.getElementById('documentDate').value;
            const documentContent = document.getElementById('documentContent').value;

            if (!companyName || !documentTitle || !recipientName || !documentDate || !documentContent) {
                alert('Please fill in all required fields.');
                return;
            }

            generatePDF(companyName, documentTitle, recipientName, documentDate, documentContent);
        });

        function generatePDF(companyName, documentTitle, recipientName, documentDate, documentContent) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            const formattedDate = new Date(documentDate).toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const leftMargin = 20;
            const rightMargin = 20;
            const topMargin = 20;
            const pageWidth = doc.internal.pageSize.width;
            const contentWidth = pageWidth - leftMargin - rightMargin;

            let currentY = topMargin;

            doc.setFontSize(18);
            doc.setFont(undefined, 'bold');
            const companyNameWidth = doc.getTextWidth(companyName);
            doc.text(companyName, (pageWidth - companyNameWidth) / 2, currentY);

            currentY += 3;
            doc.setLineWidth(1);
            doc.line((pageWidth - companyNameWidth) / 2, currentY, (pageWidth + companyNameWidth) / 2, currentY);

            currentY += 20;
            doc.setFontSize(12);
            doc.setFont(undefined, 'normal');
            const dateText = `Date: ${formattedDate}`;
            doc.text(dateText, pageWidth - rightMargin - doc.getTextWidth(dateText), currentY);

            currentY += 25;
            doc.setFontSize(16);
            doc.setFont(undefined, 'bold');
            const titleWidth = doc.getTextWidth(documentTitle);
            doc.text(documentTitle, (pageWidth - titleWidth) / 2, currentY);

            currentY += 3;
            doc.setLineWidth(0.5);
            doc.line((pageWidth - titleWidth) / 2, currentY, (pageWidth + titleWidth) / 2, currentY);

            currentY += 25;
            doc.setFontSize(12);
            doc.text(`To: ${recipientName}`, leftMargin, currentY);

            currentY += 20;
            doc.setFontSize(11);
            const contentLines = doc.splitTextToSize(documentContent, contentWidth);
            const contentHeight = contentLines.length * 6;
            const remainingSpace = doc.internal.pageSize.height - currentY - 60;

            if (contentHeight > remainingSpace) {
                doc.addPage();
                currentY = topMargin;
            }

            contentLines.forEach(line => {
                doc.text(line, leftMargin, currentY);
                currentY += 6;
            });

            currentY += 30;

            if (currentY > doc.internal.pageSize.height - 40) {
                doc.addPage();
                currentY = topMargin;
            }

            doc.setLineWidth(0.5);
            doc.line(leftMargin, currentY, leftMargin + 80, currentY);
            currentY += 8;
            doc.setFontSize(10);
            doc.setFont(undefined, 'bold');
            doc.text('Authorized Signature', leftMargin, currentY);
            currentY += 15;
            doc.setFont(undefined, 'normal');
            doc.text(companyName, leftMargin, currentY);

            const filename = `${documentTitle.replace(/[^a-z0-9]/gi, '_').toLowerCase()}_${new Date().getTime()}.pdf`;
            doc.save(filename);

            const successMessage = document.getElementById('successMessage');
            successMessage.style.display = 'block';
            setTimeout(() => successMessage.style.display = 'none', 5000);

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</x-app-layout>
