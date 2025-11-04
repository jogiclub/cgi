<div class="print-container">
    <h2 class="text-center mb-4">캠프 신청 내역서</h2>

    <table class="table table-bordered mb-4">
        <tbody>
        <tr>
            <th class="bg-light" style="width: 20%">캠프명</th>
            <td><?php echo html_escape(element('ch_num', element('camp_info', $view))); ?></td>
        </tr>
        <tr>
            <th class="bg-light">교회명</th>
            <td><?php echo html_escape(element('church_nm', element('data', $view))); ?></td>
        </tr>
        <tr>
            <th class="bg-light">교단</th>
            <td><?php echo html_escape(element('kyodan', element('data', $view))); ?></td>
        </tr>
        <tr>
            <th class="bg-light">담당자</th>
            <td><?php echo html_escape(element('resp_nm', element('data', $view))); ?></td>
        </tr>
        <tr>
            <th class="bg-light">직분</th>
            <td><?php echo html_escape(element('position', element('data', $view))); ?></td>
        </tr>
        <tr>
            <th class="bg-light">연락처</th>
            <td><?php echo html_escape(element('mobile', element('data', $view))); ?></td>
        </tr>
        <tr>
            <th class="bg-light">이메일</th>
            <td><?php echo html_escape(element('email', element('data', $view))); ?></td>
        </tr>
        </tbody>
    </table>

    <h3 class="mt-4 mb-3">참가자 현황</h3>
    <table class="table table-bordered mb-4">
        <thead>
        <tr class="bg-light">
            <th>구분</th>
            <th class="text-center">남</th>
            <th class="text-center">여</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th class="bg-light">목회자</th>
            <td class="text-right"><?php echo number_format(element('pastor_male', element('data', $view))); ?></td>
            <td class="text-right"><?php echo number_format(element('pastor_female', element('data', $view))); ?></td>
        </tr>
        <tr>
            <th class="bg-light">교사</th>
            <td class="text-right"><?php echo number_format(element('teacher_male', element('data', $view))); ?></td>
            <td class="text-right"><?php echo number_format(element('teacher_female', element('data', $view))); ?></td>
        </tr>
        <tr>
            <th class="bg-light">학생</th>
            <td class="text-right"><?php echo number_format(element('student_male', element('data', $view))); ?></td>
            <td class="text-right"><?php echo number_format(element('student_female', element('data', $view))); ?></td>
        </tr>
        <tr>
            <th class="bg-light">총 인원</th>
            <td colspan="2" class="text-right">
                <?php
                $total = element('pastor_male', element('data', $view)) +
                    element('pastor_female', element('data', $view)) +
                    element('teacher_male', element('data', $view)) +
                    element('teacher_female', element('data', $view)) +
                    element('student_male', element('data', $view)) +
                    element('student_female', element('data', $view));
                echo number_format($total);
                ?>
            </td>
        </tr>
        </tbody>
    </table>

    <h3 class="mt-4 mb-3">비용 현황</h3>
    <table class="table table-bordered mb-4">
        <tbody>
        <tr>
            <th class="bg-light" style="width: 20%">총 비용</th>
            <td class="text-right">
                <?php echo number_format($total * element('ch_pay', element('camp_info', $view))); ?>원
            </td>
        </tr>
        <tr>
            <th class="bg-light">입금액</th>
            <td class="text-right"><?php echo number_format(element('deposit', element('data', $view))); ?>원</td>
        </tr>
        <tr>
            <th class="bg-light">입금일</th>
            <td class="text-right"><?php echo element('deposit_dt', element('data', $view)); ?></td>
        </tr>
        <tr>
            <th class="bg-light">잔액</th>
            <td class="text-right">
                <?php
                $total_cost = $total * element('ch_pay', element('camp_info', $view));
                $balance = $total_cost - element('deposit', element('data', $view));
                echo number_format($balance);
                ?>원
            </td>
        </tr>
        </tbody>
    </table>

    <h3 class="mt-4 mb-3">메모</h3>
    <div class="border p-3" style="min-height: 100px;">
        <?php echo nl2br(html_escape(element('memo', element('data', $view)))); ?>
    </div>
</div>

<style>
    @media print {
        @page {
            size: A4;
            margin: 15mm;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .print-container {
            max-width: 100%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th,
        .table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .bg-light {
            background-color: #f8f9fa !important;
            -webkit-print-color-adjust: exact;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        .mt-4 {
            margin-top: 1.5rem;
        }
        .mb-3 {
            margin-bottom: 1rem;
        }
        .p-3 {
            padding: 1rem;
        }
        .border {
            border: 1px solid #ddd;
        }
    }
</style>

<script>
    window.onload = function() {
        window.print();
    };
</script>